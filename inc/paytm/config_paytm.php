<?php

	define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
	define('PAYTM_MERCHANT_KEY', 'all&MRLBLOrmuDGD'); //Change this constant's value with Merchant key received from Paytm.
	define('PAYTM_MERCHANT_MID', 'tkOskL16930420179530'); //Change this constant's value with MID (Merchant ID) received from Paytm.
	define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.
	define('INDUSTRY_TYPE_ID', 'Retail'); //Change this constant with website industry type given by paytm
	define('CHANNEL_ID', 'WEB'); //Change this constant with website channel id
	define('CALLBACK_URL', 'http://localhost/EasyParking/pay_response.php'); //Change this constant with callback url


	$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
	$PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
	if (PAYTM_ENVIRONMENT == 'PROD') {
		$PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
		$PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
	}

	define('PAYTM_REFUND_URL', '');
	define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
	define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
	define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
?>
