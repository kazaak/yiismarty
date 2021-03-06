yiismarty
=========

various plugins for the smarty templating engine (v 3.1.12) suitable for Yii MVC framework (v 1.1.12...)

Adds:
<ul>
<li><pre>
  {createUrl route="..." param1="..." param2="..."}
  </pre>
  <p>
  Invokes $controller-&gt;createUrl($route,$paramsHash) where the controller
  object is set automagically by the Yii smarty extension.
  </p>
</li>

<li><pre>
  {coreScript name="jquery"}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerCoreScript($name)
  </p>
</li>

<li><pre>
  {css id="inline-css-1"}
  .foo {
      text-decoration: blink;
  }
  {/css}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerCss().
  </p>
</li>

<li><pre>
  {script id="inline-jscript-1"}
  var foo = Math.PI;
  alert('Hello, ' + foo + '!');
  {/script}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerScript().  Supports an
  optional position parameter.  See CClientScript::registerScript().
  </p>
</li>

<li><pre>
  {headerTag id="shader-vs" type="x-shader/x-vertex"}
  // webgl shader program here :P
  {/headerTag}
  </pre>
  <p>
  I've customized ClientScript in my Yii-derived framework to support
  custom tags; this generates 
  &lt;script id="shader-vs" type="x-shader/x-vertex"&gt; ... &lt;/script&gt;
  in the &lt;head&gt;...&lt;/head&gt; section.  You'll want to remove
  block.headerTag.php or extend CClientScript to support registerHeaderTag.
  </p>

  <p>
  You may specify a tag other than &lt;script&gt; the tag parameter; otherwise,
  it defaults to script.
  </p>
</li>

<li><pre>
  {scriptFile relativeUrl="/js/foo.js"}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerScriptFile.  It supports
  either relativeUrl or absoluteUrl.  AbsoluteUrl is passed unmolested to
  registerScriptFile.  When used in a module, e.g.,
  modules/foo/views/site/index.tpl, with a relative url /js/foomodule.js,
  relativeUrl will helpfully use Yii::app()-&gt;getAssetManager()-&gt;publish()
  to automatically publish modules/foo/assets/js/foomodule.js to
  assets/&lt;8-digit-id&gt;/js/foomodule.js.  You can disable this behaviour by
  setting 'nopublish' to true; in this case, the method will prepend assets and
  the module name to the relative url, e.g., /assets/foo/js/foomodule.js.  You
  can disable all of this behaviour by setting nomodule to true.
  </p>

  <p>
  When not used in a module context, the module publishes the url created by appending $relativeUrl to Yii::getPathOfAlias("application.assets").  You can disable this behaviour by setting nopublish to true.
  </p>

  <p>
  When nomodule is set to true, or when not in a module context and nopublish is set to true, this function appends relativeUrl to Yii::app()-&gt;request-&gt;baseUrl.
  </p>

  <p>
  You may also specify a position parameter.
  See CClientScript::registerScriptFile()
  </p>
</li>

<li><pre>
  {linkTag rel="..." type="..." relativeUrl="assets/css/foo.css"}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerLinkTag.  It employs the same
  publishing logic described with {scriptFile ...} above.
  </p>
</li>

<li><pre>
  {cssFile relativeUrl="assets/css/foo.css"}
  </pre>
  <p>
  Invokes Yii::app()-&gt;clientScript-&gt;registerCssFile.  It employs the same
  publishing logic described above.
  </p>

  <p>
  Rather than supporting a position parameter, it supports a media parameter.
  See CClientScript::registerCssFile().
  </p>
</li>

<li><pre>
  &lt;img src="{assetFile relativeUrl="/img/redx.png"}"/&gt;
  </pre>
  <p>
  This is a convenience method for generating asset urls.  It supports
  relativeUrl and absoluteUrl; absoluteUrl simply echos the supplied url.
  In a module context using relativeUrl, it will use CAssetManager to
  publis the file using Yii::getPathOfAlias on "&lt;modulename&gt;.assets",
  appending the supplied url to that result and passing it to publish.  You can
  prevent this by passing the nopublish parameter; in that case, the relativeUrl
  is appended to "assets/<modulename>/".  You can prevent this by setting the
  nomodule parameter.  Unless the relativeUrl is published using getPathOfAlias,
  it is appended to Yii::app()-&gt;request-&gt;baseUrl.
  </p>
</li>

<li><pre>
  {menu}
    {menuItem label="..." url="..." visible="..."}
    {menuItem label="..." url="..." visible="..."}
  {/menu}
  </pre>

  <p>
  Populates the $this-&gt;menu array of the controller with the specified
  menu items.  I've extended CMenu to support widget="<class alias>" and an
  array of options passed to the widget.  So you can set widget="<class alias>"
  in {menuItem ...} and any parameters other than label, url, and visible are
  added to a variable called widgetOptions.
  </p>

  <p>
  To be clear, this is adding associative arrays to $this-&gt;menu in the
  current controller, set via the Yii smarty extension.  So it allows you to
  do what would equivalently be the following in the view file:
  <code>
  $this-&gt;menu = array(
    array('label' => 'home',url='/')
   ,array('visible' => 1,'widget' => 'application.components.CustomButton'
         ,'buttonLabel' => 'hello, world!')
  );
  </code>
  </p>

</li>

<li><pre>
  {jSmart}
  {include file="jsmart-template.tpl"}
  {/jSmart}
  </pre>

  <p>
  Sets the left and right delimiters on the smarty template to {{ and }}.  This allows processing of templates meant for use by jSmart.  I.e., the template can use {{ and }} to do some processing on the server side while leaving {...} blocks to be resolved by jSmart on the client side.
  </p>

  <p>
  For instance, the jsmart-template.tpl reference above can use:
  <code>
  {foreach $posts as $post}
  <article>
  <header>
  <h1>{{t cat="app" text="Title:"}}{$post.title}</h1>
  </header>
  {$post.content}
  </article>
  {/foreach}
  </code>
  This way, the server side can process the t function and leave {$post.title} to the client side.
  </p>

</li>

<li><pre>
  {breadcrumbs}
  {breadcrumbs var='Dominion' value={createUrl route="site/index"}}
  <pre>

  <p>I override CWebModule to pass a $breadcrumbs parameter; specifically, I override onBeginRequest to set the modules for my application, like this:
  <code>
   'onBeginRequest' => function() {
        // this = ugly :(  we can't do this above because Yii::app() isn't yet
        //  initialized
        // NOTE setModule will merge the module configs
        Yii::app()->setModules(array(
            'dominion' => array(
                'breadcrumbs' => array(
                    'Games' => Yii::app()->createUrl('game/index')
                )
            )
  </code>
  i.e., the breadcrumbs parameter available in $module will tell me the path to the module.
  </p>

  <p>The <code>{breadcrumbs}</code> sets the $controller-&gt;breadcrumbs to $controller-&gt;module-&gt;breadcrumbs.  The second bit, <code>{breadcrumbs var='Dominion' value={createUrl route="site/index"}}</code> Adds the url specified in value to the text specified by var to $controller-&gt;breadcrumbs.
  </p>

</li>

<li><pre>
  {plural cat="app" text="player" count={count($players)}}
  </pre>

  <p>
  This is a wrapper around the smarty yii extension's {t cat="..." text="..."} function to pluralize the text (using English) before invoking t on the pluralized result.
  </p>

</li>

<li><pre>
  {yiiclassref class="CAssetManager"}
  </pre>

  <p>Adds a CHtml::link to the specified Yii class.  A little cheeky.</p>

</ul>

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

<pre>
$ git submodule add git://github.com/yiiext/smarty-renderer.git protected/extensions/yiiext/renderers/smarty
</pre>

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

<pre>
$ git submodule add https://github.com/kazaak/yiismarty.git protected/extensions/Smarty/plugins
</pre>
