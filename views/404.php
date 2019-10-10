
<!DOCTYPE html>
<!--[if IEMobile 7 ]><html class="no-js iem7"><![endif]-->
<!--[if lt IE 9]><html class="no-js lte-ie8"><![endif]-->
<!--[if (gt IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<link href="https://cdn3.brettterpstra.com/stylesheets/screen.5608.css" media="screen, projection" rel="stylesheet" type="text/css">
	
	
	<title>404 - Page not found</title>

	<!-- http://t.co/dKP3o1e -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- open graph -->
	
	
	<meta name="description" content="The page you requested could not be found. Is there any chance you were looking for one of these? You can also check the Archives and filter posts by keyword and title, or use NerdQuery to">
	<script src="https://cdn3.brettterpstra.com/javascripts/modernizr.5608.js"></script>

</head>

<body id="error" class="pagenotfou">
  <section id="main">
    <div class="content">
<div>
<article role="article" class="post page">
  
  <header>
    <h2 class="entry-title">404 - Page not found</h2>
    
  </header>
  <div>
	<article role="article" class="post">
	  <header>
	    <h1>Uh oh.</h1>
	  </header>

	  <p>The page you requested could not be found. Is there any chance you were looking for one of these?</p>
	  <div id="searchresults"></div>
	  <p>You can also check the <a href="/archives/">Archives</a> and filter posts by keyword and title, or use <a href="http://nerdquery.com/search.php?query=&category=23&catid=23" title="NerdQuery site search">NerdQuery</a> to quickly find what you were looking for.</p>
	</article>
</div>
</article>

</div>
</div>


   <!-- Fathom - simple website analytics - https://github.com/usefathom/fathom -->
 <script>
 (function(f, a, t, h, o, m){
 	a[h]=a[h]||function(){
 		(a[h].q=a[h].q||[]).push(arguments)
 	};
 	o=f.createElement('script'),
 	m=f.getElementsByTagName('script')[0];
 	o.async=1; o.src=t; o.id='fathom-script';
 	m.parentNode.insertBefore(o,m)
 })(document, window, '//terpstra.usesfathom.com/tracker.js', 'fathom');
 fathom('set', 'siteId', 'LGQRH');
 fathom('trackPageview');
 </script>
 <!-- / Fathom -->

<script>window.basev='5608';</script>
<script>window.btProduction = 'https://cdn3.brettterpstra.com';</script>
<script src="https://cdn3.brettterpstra.com/javascripts/LAB.min.js"></script>
<script>
$LAB.script("https://cdn3.brettterpstra.com/javascripts/kingpin.min.5608.js")
	.script("https://cdn3.brettterpstra.com/javascripts/bt.min.5608.js")
	.wait(function(){
		bt.init();
		// _bsaPRO();
	})
	.wait(function(){
		$(window).resize(function() {
			bt.checkWinWidth();
			$.waypoints("destroy");
			$(".sticky-wrapper").each(function(i,n) { $(n).replaceWith($(n).contents()); });
			bt.Sticky.setup();
			$("div.lazyloaded").each(function(i,n) {
				bt.Sticky.setup($(n).attr('id'));
			});
			bt.TOC.refresh();
		});
	});
</script>
<!-- updated 2019-08-08T07:00:23-05:00 -->


</body>
</html>
