<?php

return [
  'realm_public_key' => env('KEYCLOAK_REALM_PUBLIC_KEY', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA11rpTPW/nRdbkKCusm4SwZFPgMgYfPtmv1gDKrTwGYVVaPnYhLNwB1mt96kFMxv/P3VNyet4IdR5/HZa9RVwd16NhviRTtozxWxsrgQ4Qf4MORSAIBbcLOgbTPzZcEIw20i6EXyfXiE41Q7z/osihBZE5ffKulGuP3YJjEu6MMPdIX5YZtMj/Q6l0/vS/SB6L8entL8UB5/Di6gfNVtFtD54Dp7GW/QR5lg2r7NODB+V7kN/+Tq8Zq1kcZRDI8cR31oVtPjpn6VzFpO/fasSiJV2RLx2Mx13n3AyoRnd/Gxm1OO3FFVJLE1EpgydVGzE2guOy5ZqfUWHa4OBmVo4NQIDAQAB'),

  'load_user_from_database' => env('KEYCLOAK_LOAD_USER_FROM_DATABASE', false),

  'user_provider_credential' => env('KEYCLOAK_USER_PROVIDER_CREDENTIAL', 'username'),

  'token_principal_attribute' => env('KEYCLOAK_TOKEN_PRINCIPAL_ATTRIBUTE', 'preferred_username'),

  'append_decoded_token' => env('KEYCLOAK_APPEND_DECODED_TOKEN', false),

  'allowed_resources' => env('KEYCLOAK_ALLOWED_RESOURCES', null)
];
