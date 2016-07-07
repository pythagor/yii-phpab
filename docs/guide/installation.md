Installation
============

Installing an Extension
-----------------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

        composer require pythagor/yii-phpab

or add

        "pythagor/yii-phpab": "dev-master"

to the **"require"** section of your composer.json.

Setup
-----

If you have not used composer include composer autoload in the index.php:

        require_once(__DIR__ . '/protected/vendor/autoload.php'); // path to your composer autoload
    
Add config entry into components section:

    // config/main.php file
    
    'components" = [
    ...
        'YiiPhpab' => [
            'class' => 'pythagor\yiiphpab\YiiPhpab',
        ],
    ...
    
Add new **"onAfterRender'** Event to your base Controller:

    // components/Controller.php file
    
    protected function afterRender($view, &$output)
    {
        parent::afterRender($view, $output);
        $this->onAfterRender(new CEvent($this));
    }

    public function onAfterRender($event)
    {
        $this->raiseEvent('onAfterRender', $event);
    }
