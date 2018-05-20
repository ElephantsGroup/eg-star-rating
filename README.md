To use Elephants Group star-rating module first you must install module, then you can use star-rating widget anywhere in your website.

Installation Steps:
===

1) run
> php composer.phar require elephantsgroup/eg-star-rating "*"

or add `"elephantsgroup/eg-star-rating": "~1"` to the require section of your composer.json file.

2) migrate database
> yii migrate --migrationPath=vendor/elephantsgroup/eg-star-rating/migrations

3) add star-rating module to common configuration (common/config.php file)

```'modules' => [
    ...
    'star-rating' => [
        'class' => 'elephantsGroup\starRating\Module',
    ],
    ...
]```

4) open access to module in common configuration

```'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        ...
        'star-rating/ajax/*',
        ...
    ]
]```

5) filter admin controller in frontend configuration (frontend/config.php file)

```'modules' => [
    ...
    'star-rating' => [
        'as frontend' => 'elephantsGroup\starRating\filters\FrontendFilter',
    ],
    ...
]```

5) filter ajax controller in backend configuration (backend/config.php file)

```'modules' => [
    ...
    'star-rating' => [
        'as backend' => 'elephantsGroup\starRating\filters\BackendFilter',
    ],
    ...
]```

Using star-rating widget
===

Anywhere in your code you can use star-rating widget as follows:
```<?= Rate::widget() ?>```

You need to use Rate widget header in your page:
```use elephantsGroup\starRating\components\Rate;```

Rate widget parameters
---

- item (integer): to separate Rate between different items.
```<?= Rate::widget(['item' => 1]) ?>```
```<?= Rate::widget(['item' => $model->id]) ?>```

default value for item is 0
- service (integer): to separate star-rating between various item types.
```<?= Rate::widget(['service' => 1, 'item' => $model->id]) ?>```

for example you can use different values for different modules in your app, and then use star-rating widget separately in modules.
default value for service is 0
- min_num (integer): minimum possible rate vote
```<?= Rate::widget(['service' => 1, ''item' => $model->id, 'min_num' => 1]) ?>```

- max_num (integer): maximum possible rate vote
```<?= Rate::widget(['service' => 1, ''item' => $model->id, 'min_num' => 1, 'max_num' => 5]) ?>```

- view_file (string): the view file path for rendering

```<?= Rate::widget([
    'service' => 1,
    'item' => $model->id,
    'color' => 'yellow',
    'view_file' => Yii::getAlias('@frontend') . '/views/star-rating/widget.php'
]) ?>```

you can use these variables in your customized view:
* service
* item
* min_num
* max_num
* rate_num