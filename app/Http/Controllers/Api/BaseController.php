<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;

    class BaseController {

        /**
         * Success response method.
         */
        public function sendResponse($result, $message, $code = 200) {

            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];

            if ($result == null){
                unset($response['data']);
            }

            return response()->json($response, $code);
        }

        /**
         * Error response method.
         */
        public function sendError($error, $errorMessages = [], $code = 400) {

            $response = [
                'success' => false,
                'message' => $error,
            ];

            if (!empty($errorMessages)) {
                $response['errors'] = $errorMessages;
            }

            return response()->json($response, $code);
        }
    }
?>