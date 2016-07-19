Separate Views Usage
====================

### Usable for complex code blocks testing.

Inside of the Controller Action or Widget create a Test instance:

    // controllers/SiteController.php file
    
    $myABTest = Yii::app()->YiiPhpab->addTest(
        'firsttest',                             // Test name
        $this,                                   // Current Controller instance
        \pythagor\yiiphpab\PhpabTest::MODE_TRIAL // Test Mode
    );

Assign params to the Test Views:

    // controllers/SiteController.php file
    
    $viewParams = [
        'name' => 'Your Test Name',
    ];

Add Test Variations:

    // controllers/SiteController.php file
    
    use pythagor\yiiphpab\PhpabVariation;
    
    ...
    
    // add default variation
    $myABTest->addVariation(
        new PhpabVariation(
            'default_view', // Variation Name
            'view_a',       // Variation Render View
            $viewParams     // View Parameters
        )
    );
    
    // add another variation
    $myABTest->addVariation(
        new PhpabVariation(
            'new_view',
            'view_b',
            $viewParams
        )
    );

Create separate view for each of the Variations:
    
    // views/view_a.php file
    
    // Use $name variable from viewParams
    
    <h2><?php echo CHtml::encode($name); ?>! You are in the default group</h2>

<!-- -->

    // views/view_b.php file
    
    <h2><?php echo CHtml::encode($name); ?>! You are in the new group</h2>

Insert the **renderVariations** directive into the main view file:

    // views/index.php file
    
    <?php
    /**
     * @var $this SiteController
     * @var $myABTest \pythagor\yiiphpab\PhpabTest
     */
    
    $this->pageTitle=Yii::app()->name;
    ?>
    
    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
    
    <?php echo $myABTest->renderVariations(); ?>
    
    <p>Congratulations! You have successfully created your Yii application.</p>

Render main view with the test instance passed:

    // controllers/SiteController.php file
    
    $this->render('index', [
        'myABTest' => $myABTest,
    ]);

Go to your GA account to view the analytics (if production mode has been enabled).
