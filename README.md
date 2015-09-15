### Openfire Symfony Bundle

Bundle used to connect to Openfire REST API and perform common tasks.

## Installation

By composer :

```
"require": {
    "jean553/symfony-openfire-bundle": "dev-master"
}
```

## Use

app/config/config.yml :

```
openfire:
    url: 'http://my-openfire-server:9090/plugins/restapi/v1'
    secret: 'abcdefghijklmnopqrst'
```

In controller :

```
$service = $this->get('openfire.service');
$service->createUser('username', 'password');
```
