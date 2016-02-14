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
\Smarrt\Dot::with($data)->set('api.new_method.args.0', 'param_1');

```

###get
```php
<?php

// assoc keys
\Smarrt\Dot::with($data)->get('api.set');

// also you can use index keys
Smarrt\Dot::with($data)->get('paths.0.1');

//if key is not exists, you can set default return value
\Smarrt\Dot::with($data)->get('api.new_method.args.0', 'default_arg');

```

###remove
```php
<?php

// assoc keys
\Smarrt\Dot::with($data)->get('api.set');

// also you can use index keys
Smarrt\Dot::with($data)->get('paths.0.1');

//if key is not exists, you can set default return value
\Smarrt\Dot::with($data)->get('api.new_method.args.0', 'default_arg');

```