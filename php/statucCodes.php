<?php
	class statucCodes{
	
		const HTTP_BAD_ERROR = '400 Bad Request';
		const HTTP_NOT_FOUND_ERROR = '404 Not Found';
		const HTTP_INTERNAL_SERVER_ERROR = '500 Internal Server Error';
		const HTTP_SERVICE_UNAVAILABLE_ERROR = '503 Service Unavailable';
		const HTTP_SERVER_READ_ERROR = '598 Network Read Timeout';
		const HTTP_AUTHENTICATE_ERROR = '401 Authentication Failed';
		const HTTP_REQUEST_TIME_OUT = '408 Request Timeout';
		const HTTP_MULTIPLE_REQUEST = '429 Too Many Requests';
		const HTTP_GATEWAY_ERROR = '504 Gateway Timeout';
		const HTTP_NOT_SUPPORTED = '415 Un-supported Media Type';
		const HTTP_REJECTED = '403 Forbidden';
		const HTTP_BAD_GATEWAY = '502 Bad Gateway';

	} // --- end class

?>