#Smarrt - smart array access.

##Dot-Notation access api


###set
```php
<?php

// assoc keys
\Smarrt\Dot::with($data)->set('api.set', 'done');

// also you can use index keys
Smarrt\Dot::with($data)->set('paths.0.1', 'app/models');

//if key is not exists, it will be created
\Smarrt\Dot::with($data)->set('api.not_exists_key.0', 'new_value');

```

###get
```php
<?php

// assoc keys
\Smarrt\Dot::with($data)->get('api.set');

// also you can use index keys
Smarrt\Dot::with($data)->get('paths.0.1');

//if key is not exists, you can set default return value
\Smarrt\Dot::with($data)->get('api.not_exists_key.0', 'default_value');

```

###remove
```php
<?php

// assoc keys
\Smarrt\Dot::with($data)->remove('api.set');

// also you can use index keys
Smarrt\Dot::with($data)->remove('paths.0.1');

```