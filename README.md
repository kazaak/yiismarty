yiismarty
=========

various plugins for the smarty templating engine (v 3.1.12) suitable for Yii MVC framework (v 1.1.12...)

These are the plugins I've created to further incorporate the Smarty PHP
templating engine (http://www.smarty.net/) into the Yii MVC framework
(http://yiiframework.com/).  This is an elaboration on the work in the smarty
view renderer for yii, which can be found here: 
http://www.yiiframework.com/extension/smarty-view-renderer/.

It's entirely possible I've missed something, but the suggested class alias for
config/main.php (application.extensions.yiiext.renderers.smarty.ESmartyViewRenderer)
seems to require putting this under
protected/extensions/yiiext/renderers/smarty; so to add the yiiext smarty
renderer to my project, I did this:

$ git submodule add git://github.com/yiiext/smarty-renderer.git protected/extensions/yiiext/renderers/smarty

Next I put smarty in protected/vendors/Smarty, e.g., Smarty.class.php et. al.
should be in that directory.

The config/main.php 'viewRenderer' component needs to be like this:

       ,'viewRenderer'=>array(
          'class'=>'application.extensions.yiiext.renderers.smarty.ESmartyViewRenderer',
            'fileExtension' => '.tpl',
            'pluginsDir' => 'application.extensions.yiiext.renderers.smarty.plugins',
            //'configDir' => 'application.smartyConfig',
        )

NOTE pluginsDir change from extension documentation.  The extension itself adds
ext.Smarty.plugins, which for me doesn't exist, so that's where I have this
project, e.g.:

$ git submodule add https://github.com/kazaak/yiismarty.git protected/extensions/Smarty/plugins
