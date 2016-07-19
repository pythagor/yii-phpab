Inline Usage
============

### Usable for single lines, phrases or even words testing.

Inside of the Controller Action or Widget create a Test instance:

    // controllers/SiteController.php file
    
    use pythagor\yiiphpab\PhpabTest;
    
    ...
    
    $myInlineABTest = Yii::app()->YiiPhpab->addTest(
        new PhpabTest(
            'inlinetest',         // Test name
            $this,                // Current Controller instance
            PhpabTest::MODE_TRIAL // Test Mode
        )
    );

Add Test Variation:

    // controllers/SiteController.php file
    
    use pythagor\yiiphpab\PhpabVariation;
    
    ...
    
    $myInlineABTest->addVariation(
        new PhpabVariation(
            'inline_second_variation', // Variation Name
            '_inline_second_variation' // Variation View
        )
    );

Create separate view for each of the new Variations:

    // views/_inline_second_variation.php file
    
    <b>A/B Test</b>

Insert default Variation inline into the main view file:

    // views/index.php file
    
    <?php
    /**
     * @var $this SiteController
     * @var $myInlineABTest \pythagor\yiiphpab\PhpabTest
     */
    
    $this->pageTitle=Yii::app()->name;
    ?>
    
    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
    
    <p>Congratulations! You have successfully created your {phpab <?php echo $myInlineABTest->getName(); ?>}Yii application{/phpab <?php echo $myInlineABTest->getName(); ?>}.</p>

Render main view with the test instance passed:

    // controllers/SiteController.php file
    
    $this->render('index', [
        'myInlineABTest' => $myInlineABTest,
    ]);
    
Go to your GA account to view the analytics (if production mode has been enabled).
