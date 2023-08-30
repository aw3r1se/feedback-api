# Simple Feedback API
### Installing initial dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

### Deployment in Docker
```
- cp .env.example .env
- alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
- sail up -d --build
- sail composer install
- sail artisan key:generate
- sail artisan jwt:generate
- sail artisan migrate --seed
```
