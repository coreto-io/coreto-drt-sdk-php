# Coreto DRT SDK

An Laravel SDK used to interact with the Coreto DRS

## Dependencies

* PHP >=7.4

## Installation via Composer

To install simply run:

```
composer require coreto/coreto-drt-sdk
```

Or add it to `composer.json` manually:

```json
{
    "require": {
        "coreto/coreto-drt-sdk": "~1"
    }
}
```

## Direct usage

```php
use Coreto\CoretoDRTSDK\Client;

$client = new Client(
  $apiUrl, // The base URL of the API
  $callerAccountId, // The account ID of the caller (must be a registered source)
  $callerPrivateKey // The private key of the caller
);
```

### Save actions batch
```php
$response = $client->saveActionsBatch([
  'batch' => [[
    'account_did' => 'did:example:example1',
    'action_date' => 1669121362000,
    'action_type' => 'react',
    'trust' => 1,
    'performance' => 0.3,
    'identifier' => 123
  ], [
    'account_did' => 'did:example:example2',
    'action_date' => 1669121369000,
    'action_type' => 'comment',
    'trust' => 0.7,
    'performance' => 1,
    'identifier' => 124
  ]]
]);
// [
//   'hash' => '8cAXpSnCyoUTmtE32wrzVuldgC9ro3EHLNy4EzRXQUkg'
// ]
// on error returns null
// on error returns null
```

### Sava action
```php
$response = $client->saveAction([
    'account_did' => 'did:example:example',
    'action_date' => 1669121362000,
    'action_type' => 'react',
    'trust' => 1,
    'performance' => 1,
    'identifier' => 123
]);
// [
//   'hash' => '8cAXpSnCyoUTmtE32wrzVuldgC9ro3EHLNy4EzRXQUkg'
// ]
// on error returns null
```

### Get user actions
```php
$response = $client->getUserActions([
  'source_label' => 'example',
  'account_did' => 'did:example:example',
]);
// [{
//   'account_did' => 'did:example:example1',
//   'action_date' => 1669121362000,
//   'action_type' => 'react',
//   'trust' => 1,
//   'performance' => 0.3,
//   'identifier' => 123
// }, {
//   'account_did' => 'did:example:example2',
//   'action_date' => 1669121369000,
//   'action_type' => 'comment',
//   'trust' => 0.7,
//   'performance' => 1,
//   'identifier' => 124
// }]
```

### Get user trust actions
```php
$response = $client->getUserTrustActions([
  'source_label' => 'example',
  'account_did' => 'did:example:example',
]);
// [{
//   'account_did' => 'did:example:example1',
//   'action_date' => 1669121362000,
//   'action_type' => 'react',
//   'trust' => 1,
//   'performance' => 0,
//   'identifier' => 123
// }, {
//   'account_did' => 'did:example:example2',
//   'action_date' => 1669121369000,
//   'action_type' => 'comment',
//   'trust' => 0.7,
//   'performance' => 0,
//   'identifier' => 124
// }]
```

### Get user performance actions
```php
$response = $client->getUserPerformanceActions([
  'source_label' => 'example',
  'account_did' => 'did:example:example',
]);
// [{
//   'account_did' => 'did:example:example1',
//   'action_date' => 1669121362000,
//   'action_type' => 'react',
//   'trust' => 0,
//   'performance' => 0.9,
//   'identifier' => 123
// }, {
//   'account_did' => 'did:example:example2',
//   'action_date' => 1669121369000,
//   'action_type' => 'comment',
//   'trust' => 0,
//   'performance' => 0.2,
//   'identifier' => 124
// }]
```

### Get source action types
```php
$response = $client->getSourceActionTypes([
  'source' => 'source.near'
]);
// ['react', 'comment', 'opinion']
```

### Create DID
```php
$response = $client->createDID();
// [
//   'did' => 'did:example:example',
//   'seed' => 'seed_example'
// ]
// on error returns null
```

### Put DID
```php
$response = $client->putDID([
  'account_id' => 'example.near',
  'did' => 'did:example:example'
]);
// [
//   'hash' => '8cAXpSnCyoUTmtE32wrzVuldgC9ro3EHLNy4EzRXQUkg'
// ]
// on error returns null
```

### Get DID
```php
$response = $client->getDID([
  'account_id' => 'example.near'
]);
// did:example:example
// on error returns null
```

### Has DID
```php
$response = $client->hasDID([
  'account_id' => 'example.near'
]);
// true
// on error returns null
```

### Transfer DID
```php
$response = $client->transferDID([
  'old_account_id' => 'old_example.near',
  'new_account_id' => 'new_example.near',
]);
// [
//   'hash' => '8cAXpSnCyoUTmtE32wrzVuldgC9ro3EHLNy4EzRXQUkg'
// ]
// on error returns null
```

### Get current block height
```php
$response = $client->getCurrentBlockHeight();
// 105783543
// on error returns -1
```

### Get account balance
```php
$response = $client->getBalance('example.near');
// 25
// on error returns null
```

## Errors
```php
// Smart contract error
[
  'error' => 'The error resulted from the smart contract',
  'type' => 'The error type resulted from the smart contract'
]

// Internal server error
[
  'error' => 'The error resulted from the server',
  'statusCode' => 'The error status code resulted from the server',
  'message' => 'The error message resulted from the server'
]
```

## Todo

1. Add unit and integration tests
2. Update documentation
