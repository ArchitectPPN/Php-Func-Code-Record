<?php

public function adminAddTicket( array $input, int $iUserId = 0 )
	: int
	{
		// 免费票不能生成折扣码
		if ($input['iPrice'] == 0 && !empty($input['sDiscountCode'])) {
			throw new EventServiceException(EventServiceException::FREE_TICKET_NOT_CODE);
		} else if ($input['iPrice'] != 0 && $input['iPrice'] < 0.5) {
			throw new EventServiceException(EventServiceException::TOTAL_AMOUNT_SO_LOW);
		}

		if (!empty($input['sDiscountCode'])) {
			// 填写了折扣码, 折扣必须大于0
			if ($input['iDisPercentNum'] <= 0 && $input['iDisPercentNum'] > 99) {
				throw new EventServiceException(EventServiceException::DISCOUNT_NUM_MUST_MORE_ZERO);
			}

			// 有折扣码, 那么折扣码必须为8位
			if (!(strlen($input['sDiscountCode']) == 8)) {
				throw new EventServiceException(EventServiceException::DISCOUNT_NUM_MUST_MORE_ZERO);
			}

			$bIsMatches = preg_match('/^[a-zA-Z0-9]+$/u', $input['sDiscountCode'], $aMatches);
			if (!$bIsMatches) {
				throw new EventServiceException(EventServiceException::DISCOUNT_NUM_CANT_USE);
			}

			$price = $input['iPrice'] * (1 - $input['iDisPercentNum'] / 100);
			if ($price < 0.5) {
				throw new EventServiceException(EventServiceException::TOTAL_AMOUNT_SO_LOW);
			}
		}

		// 折扣率不为零, 必须存在
		if (empty($input['sDiscountCode']) && !empty($input['iDisPercentNum'])) {
			throw new EventServiceException(EventServiceException::DISCOUNT_NUMBER_CANNOT_EMPTY);
		}

		// 检查场次是否存在
		$aSessionInfo = EventSessionData::getInstance()->getFirstOne([ [ 'iSessionId', '=', $input['iSessionId'] ] ]);
		if (empty($aSessionInfo)) {
			throw new EventServiceException(EventServiceException::EVENT_SESSION_NOT_EXIST);
		}

		$dtSessionBeginTm = $aSessionInfo['dtStartDate'] . ' ' . $aSessionInfo['dtStartTime'];
		$dtSessionEndTm   = $aSessionInfo['dtEndDate'] . ' ' . $aSessionInfo['dtEndTime'];

		// 检查该活动是否存在
		$aEventData = EventData::getInstance()->getFirstOne([ [ 'iEventId', '=', $aSessionInfo['iEventId'] ] ]);
		if (empty($aEventData)) {
			throw new EventServiceException(EventServiceException::EVENT_NOT_EXIST);
		}

		// 如果勾选了活动结束前均可报名, 默认报名时间为活动开始结束时间(或者用户未填写)
		if (($input['iOrderTime'] == TicketData::ONE)) {
			$aTicketData['dtOrderStartTime'] = Carbon::now()->toDateTimeString();
			$aTicketData['dtOrderEndTime']   = $aEventData['dtEndTime'];
		} else if (!empty($input['dtOrderStartTime']) && !empty($input['dtOrderEndTime'])) {
			// 订购开始日期不能晚于活动结束日期
			if ($input['dtOrderStartTime'] > $dtSessionEndTm) {
				throw new EventServiceException(EventServiceException::TICKET_START_TIME_BIGGER_EVENT_TIME);
			}
			$aTicketData['dtOrderStartTime'] = $input['dtOrderStartTime'];

			// 购票结束时间不能早于开始时间
			if ($input['dtOrderStartTime'] > $input['dtOrderEndTime']) {
				throw new EventServiceException(EventServiceException::TICKET_END_TIME_BIGGER_EVENT_TIME);
			}

			// 购票结束时间不晚于活动结束时间
			if ($input['dtOrderEndTime'] > $dtSessionEndTm) {
				throw new EventServiceException(EventServiceException::TICKET_END_TIME_BIGGER_EVENT_END_TIME);
			}

			$aTicketData['dtOrderEndTime'] = $input['dtOrderEndTime'];
		} else {
			// 用户未填写开始购票日期
			$aTicketData['dtOrderStartTime'] = Carbon::now()->toDateTimeString();
			$aTicketData['dtOrderEndTime']   = $aEventData['dtEndTime'];
		}

		// 如果勾选票券有效期, 票券为活动开始结束时间
		if (($input['iIsTicketActive'] == TicketData::ONE)) {
			$aTicketData['dTicketStartTime'] = $dtSessionBeginTm;
			$aTicketData['dTicketEndTime']   = $dtSessionEndTm;
		} else if (!empty($input['dTicketStartTime']) && !empty($input['dTicketEndTime'])) {
			// 票券有效期的开始时间不能早于活动开始时间
			if ($input['dTicketStartTime'] < $dtSessionBeginTm) {
				throw new EventServiceException(EventServiceException::TICKET_VALID_TIME_SMALL_EVENT_TIME);
			}
			// 票券有效期的结束时间不能晚于活动结束时间
			if ($input['dTicketEndTime'] > $dtSessionEndTm) {
				throw new EventServiceException(EventServiceException::TICKET_VALID_TIME_BIGGER_EVENT_TIME);
			}
			// 票券有效期结束时间不能早于开始时间
			if ($input['dTicketEndTime'] < $input['dTicketStartTime']) {
				throw new EventServiceException(EventServiceException::TICKET_INVALID_TIME_SMALL_THAN_VALID_TIME);
			}
			$aTicketData['dTicketStartTime'] = $input['dTicketStartTime'];
			$aTicketData['dTicketEndTime']   = $input['dTicketEndTime'];
		} else {
			$aTicketData['dTicketStartTime'] = $aEventData['dtBeginTime'];
			$aTicketData['dTicketEndTime']   = $aEventData['dtEndTime'];
		}

		$aTicketData['dtCommitTime'] = Carbon::now()->toDateTimeString();
		$aTicketData['iUserId']      = $iUserId;

		// 票券张数为0, 表示不限制张数
		if (isset($input['iTicketNum']) && $input['iTicketNum'] > 0) {
			// 票数必须大于限购数
			if ($input['iUserLimitNum'] > $input['iTicketNum']) {
				throw new EventServiceException(EventServiceException::LIMIT_NUM_ERROR);
			}
		}

		$this->checkMoneyPoint($input['iPrice']);

		// 放大到美分单位
		$input['iPrice'] *= 100;

		$aTicketData['iSessionId']      = $aSessionInfo['iSessionId'];                              // 场次ID
		$aTicketData['iEventId']        = $aEventData['iEventId'];                                  // 活动ID
		$aTicketData['iUserLimitNum']   = $input['iUserLimitNum'];                                  // 限购票数
		$aTicketData['iTicketNum']      = $input['iTicketNum'];                                     // 票数
		$aTicketData['iDisPercentNum']  = $input['iDisPercentNum'];                                 // 折扣
		$aTicketData['iPrice']          = $input['iPrice'];                                         // 票价
		$aTicketData['sTicket']         = $input['sTicket'];                                        // 票种名称
		$aTicketData['sTicketDetail']   = $input['sTicketDetail'];                                  // 票种说明
		$aTicketData['iStatus']         = $input['iStatus'];                                        // 售票状态
		$aTicketData['iIsTicketActive'] = $input['iIsTicketActive'];                                // 票券过期时间是否是用户定义
		$aTicketData['iOrderTime']      = $input['iOrderTime'];                                     // 订购日期是否是用户自定义
		!isset($input['sDiscountCode']) && $aTicketData['sDiscountCode'] = $input['sDiscountCode']; // 折扣码

		// 删除input
		unset($input);

		$iTicketId = TicketData::getInstance()->insertGetId($aTicketData);

		return $iTicketId;
	}