yiismarty
=========

various plugins for the smarty templating engine (v 3.1.12) suitable for Yii MVC framework (v 1.1.12...)

Adds:
  {coreScript name="jquery"}
  Invokes Yii::app()->clientScript->registerCoreScript($name)

  {css id="inline-css-1"}
  .foo {
      text-decoration: blink;
  }
  {/css}
  Invokes Yii::app()->clientScript->registerCss().

  {script id="inline-jscript-1"}
  var foo = Math.PI;
  alert("Hello, foo!");
  {/css}
  Invokes Yii::app()->clientScript->registerScript().  Supports an optional
  position parameter.  See CClientScript::registerScript().

  {headerTag id="shader-vs" type="x-shader/x-vertex"}
  // webgl shader program here :P
  {/headerTag}
  I've customized ClientScript in my Yii-derived framework to support
  custom tags; this generates 
  <script id="shader-vs" type="x-shader/x-vertex"> ... </script>
  in the <head>...</head> section.  You'll want to remove
  block.headerTag.php or extend CClientScript to support registerHeaderTag.

  {scriptFile relativeUrl="assets/js/foo.js"}
  Invokes Yii::app()->clientScript->registerScriptFile.  It supports either
  relativeUrl or absoluteUrl.  AbsoluteUrl is passed unmolested to
  registerScriptFile.  When used in a module, e.g.,
  modules/foo/views/site/index.tpl, with a relative url assets/js/foomodule.js,
  relativeUrl will helpfully use Yii::app()->getAssetManager()->publish() to
  automatically publish modules/foo/assets/js/foomodule.js to
  assets/<8-digit-id>/js/foomodule.js.  You can disable this behaviour by
  setting 'nopublish' to true; in this case, the method will prepend the
  module name to the relative url, e.g., foo/assets/js/foomodule.js.  You can
  disable all of this behaviour by setting nomodule to true.

  You may also specify a position parameter.
  See CClientScript::registerScriptFile()

  {cssFile relativeUrl="assets/css/foo.css"}
  Invokes Yii::app()->clientScript->registerCssFile.  It employs the same
  publishing logic described above.

  Rather than supporting a position parameter, it supports a media parameter.
  See CClientScript::registerCssFile()

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
