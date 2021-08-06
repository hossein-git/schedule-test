<?php

return [
    /**
     * The life time of tokens in seconds.
     */
    'token_ttl' => 120,

    /**
     * You may provide a middleware throttler to throttle
     * the requesting and submission of the tokens.
     */
    'throttler_middleware' => 'throttle:3,1',
];
