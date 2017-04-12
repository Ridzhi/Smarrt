# Smarrt - smart arrays.

## Dot-Notation access api
**Dot implements ArrayAccess interface.**
```php
$arr = [
	...
];

$dot = new Dot($arr);
```
### set
```php
// assoc arrays
$dot['node1.node2'] = 'value';

// also you can use dot with indexed array
$dot['node1.node2.0.1'] = 'value'; //equal $dot['node1']['node2'][0][1] = 'value'

// if key is not exists, it will be created
$dot['node1.not_exists_key'] = 'value';
```
### get
```php
// equal $email = $dot['feedbacks'][0]['email']
// if key is not exists, return null
$email = $dot['feedbacks.0.email'];
```
### unset/isset/empty
```php
unset($dot['node1.node2'])
isset($dot['node1.node2'])
empty($dot['node1.node2'])
```
