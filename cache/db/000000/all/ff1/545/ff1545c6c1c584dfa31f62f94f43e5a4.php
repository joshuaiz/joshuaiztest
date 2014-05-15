;tS<?php exit; ?>a:6:{s:10:"last_error";s:0:"";s:10:"last_query";s:56:"SELECT wp_posts.* FROM wp_posts WHERE ID IN (284,239,15)";s:11:"last_result";a:3:{i:0;O:8:"stdClass":23:{s:2:"ID";s:2:"15";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-03-14 04:33:15";s:13:"post_date_gmt";s:19:"2014-03-14 09:33:15";s:12:"post_content";s:9739:"<p>After working with Coda/Coda 2 and FTP for a few years, it was time to make a workflow upgrade. Don't get me wrong, Coda 2 is pretty amazing: my main Coda 2 window was fully customized to my liking, all my sites were organized, connecting to web servers was a breeze with FTP built-in and I had amassed a robust collection of snippets (err, "Clips" in Coda) that served me well. And no, I was not "going commando" as <a href="http://css-tricks.com/deployment/">Chris Coyier</a> laments against — that is, working on the remote files directly. I always work on local versions of the file(s), do any precompiling of my Sass/SCSS in CodeKit and then would publish to the server in Coda 2 with a simple key command (see tip below). I used Tower for version control with GitHub and everything was fine and dandy.</p>

<p>But it <em>wasn't</em>. For one, even though my Coda 2/CodeKit workflow was pretty fast, I was still using the mouse (or trackpad as it were) way too much. All these little movements add up to hours and hours of wasted time. In addition, I knew I wasn't really using Git/GitHub properly. Yes, changes were being tracked, commits were being made and version control certainly saved my ass a few times but I knew there was way more to it. What's more, I was starting to get more into actual coding and needed a proper development environment that could make things easier and faster.</p>

<p>My requirements were as follows:</p>

<ul>
<li>do everything I could do in Coda 2: FTP, code snippets, command line</li>
<li>publish to GitHub and to either a production or live server simultaneously</li>
<li>have a properly set up development environment to start running code locally (like node.js)</li>
</ul>

<p>Changes (and major ones) would have to be made but I was ready. I knew there would be a lot to learn but I was ready for that too.</p>

<h3>Enter Sublime Text 3</h3>

<p>Sublime Text 2 was not completely foreign to me — I had used it a few times but never really delved in fully until recently. This seemed like the perfect time to check it out in more detail. After spending a couple days with <a href="http://sublimetext.com/">Sublime Text 3</a> and watching this great <a href="https://tutsplus.com/course/improve-workflow-in-sublime-text-2/">tutorial</a> by Jeffrey Way at Tuts+, I finally got my head around it. <strong>Holy Package Control!</strong> <strong>All of the things!</strong> I was hooked.</p>

<p>ST3 is just so powerful it's mindblowing. With just a few plugins added through Package Control I'm already typing about half as much and that's just scratching the surface. There are so many things I wasn't using with Coda 2 that are simply indispensable to me now: Emmet (previously Zen Coding), Fetch, superior snippet integration, amazing Git support, Xiki — the list goes on. In ST3 these aren't just bells and whistles but tools that help you to not only code faster but code better. Just going through the process of getting ST3 set up changes the way you use your computer for other things.</p>

<h3>Super Pro Workflow</h3>

<p>Next it was time to set up Git + GitHub as well as my deployment location on the server so that I could keep everything in sync and do it all from ST3. This is assuming you have MAMP setup on your local machine and using WordPress.</p>

<p><strong>Here are the steps:</strong></p>

<ol>
<li>Set up RSA key authentication on GitHub. From your account, go to Account Settings > Applications > Personal Access Token > Create new token.</li>
<li>Get <a href="https://sublimegit.net">SublimeGit</a> with Package Control.</li>
<li>Create new local repo: <code>git init</code></li>
<li>Make your first commit: <code>git commit -m "first commit"</code></li>
<li>Set up your github remote repo: <code>git remote add origin https://github.com/joshuaiz/joshuaiz.git</code></li>
<li>Push your local repo to GitHub: <code>git push -u remote origin master</code></li>
<li>Then SSH to your web server location (in my case DreamHost)</li>
<li>Clone your repo: <code>git clone git://github.com/joshuaiz/joshuaiz.git</code></li>
<li>Your site is now deployed!</li>
<li>Keeping it in sync is simple. In the git working directory on your web server, just create a php file with the following: <code>&lt;?php &#96;git pull&#96;;</code></li>
<li>Then go to your repo on GitHub: http://github.com/youraccount/yourrepo.git > Settings > Webhooks &amp; Services > Add Webhook and create a web hook with the URL to the php file you created in the previous step: http://yoursite.com/wp-content/themes/yourtheme/github.php. Now, whenever you push to your repo, GitHub will send a POST request to that file location which will keep your web server in perfect sync! Sweetness.</li>
</ol>

<p>More info about these steps <a href="http://www.blog.philiptutty.com/?p=67">here</a>. There are lots of other deployment scripts out there with all kinds of configuration options but you really don't need any of those. The <code>git pull</code> file (in backtics) is a git command within a php file and that's all you really need to keep everything updated. Jeffery Way also mentions this in his Sublime Text tutorial. Note that you can do all of the Git steps from within ST3 using SublimeGit.</p>

<p>You might be saying what's the big deal here? In short, this changes everything.</p>

<p>Here was my workflow before:</p>

<ul>
<li>Install WordPress on a remote test domain</li>
<li>Copy base theme files over using my fork of Bones - <a href="http://wearebio.com/osseous/">Osseous</a> by dragging in Coda 2</li>
<li>Drag files back to my local Sites/mysite/ folder</li>
<li>Create local repo</li>
<li>Create remote repo on GitHub</li>
<li>Work on local files in Coda 2. Use CodeKit workaround (see below) for Coda 2 to see changed compiled Sass/SCSS files</li>
<li>Publish to server with key command</li>
<li>Switch from Coda 2 to browser; refresh browser</li>
<li>Make changes in Chrome Dev Tools</li>
<li>Copy changes in Chrome, update local files</li>
<li>Rinse, repeat</li>
<li>Use Tower to push changes to GitHub</li>
</ul>

<p>And now:</p>

<ul>
<li>Set up local and GitHub remote repos</li>
<li>Set up MAMP to work on files locally</li>
<li>Add project to CodeKit (no workaround necessary). Set CodeKit to refresh local browser on save</li>
<li>Work on local files</li>
<li>Switch to browser and back to ST3 with Command-Tab (switch applications)</li>
<li>Once ready to deploy, start from step 7 above</li>
<li>Continue to work locally, push commits to GitHub using SublimeGit and use <a href="https://github.com/jplew/SyncDB">SyncDB</a> with Xiki within ST3 (see below) and everything is synced: content, database, plugins, everything.</li>
</ul>

<p>BOOM! This is so much faster. Just working locally saves so much time as your pages refresh pretty much instantly instead of waiting for a live server to reload. Again. And again.</p>

<p><strong>Content</strong>: Just started playing around with this <a href="https://github.com/jplew/SyncDB">SyncDB script</a> which can upload your local db to your web server and then automatically find/replace your local/live URLs. It also syncs your /uploads folder using <code>rsync</code>. When configured, you can upload and replace your WP db with a single command in Terminal: <code>./syncdb push</code> or <code>pull</code> to sync down. Absolutely amazing. If you've used the fantastic <a href="https://interconnectit.com/products/search-and-replace-for-wordpress-databases/">Interconnectit db search and replace script</a>, SyncDB has this built in. What's more, you can create a Xiki Buffer and run syncdb right from within ST3! This is a game changer.</p>

<h3>Final Thoughts</h3>

<p>After working with this system for a few short days I could not be happier. I'll still use Coda 2 for quick updates of old projects but moving forward I will be using ST3 for everything. I'm sure there will be some tweaks so I'll post an update in a few weeks.</p>

<p>Now, if only I could settle on one of the many custom Sublime Text themes available, I may end up actually getting some work done. Speaking of which, if you'd like to create your own ST2/3 theme, here's a handy little Chrome app: <a href="http://tmtheme-editor.herokuapp.com/">http://tmtheme-editor.herokuapp.com/</a>. It's a little buggy and freezes up on occasion but it's fun to play around with. I've created a few derivitive themes and I'm getting closer to a perfect one.</p>

<blockquote>
  <h3>Tip: Getting Coda 2 to see changes in your CodeKit compiled files</h3>
  
  <p>While Coda 2 + CodeKit work well together, Coda 2 doesn't recognize out of the box that CodeKit compiled files (for example Sass/LESS) have been changed and thus does not mark them as ready to be published. There is a workaround however:</p>
  
  <p>Navigate to your compiled files in Finder. In my case it was style.css and ie.css. Right-click on each CodeKit compiled file to show the contextual menu and go to Open With... Here you want to select CodeKit — it may not be in the menu so if not go down to "Other...". Navigate to /Applications/CodeKit.app and select it. CodeKit will give you a warning saying the file is already part of a project — just click OK. Do this for <em>each</em> compiled file and then Coda 2 will now see them as changed and ready to be published. In Coda 2 you can use Shift-Command-P to publish all changed files in one go. See image below to see the contextual menu for selecting the CodeKit app.</p>
</blockquote>

<p><a href="http://joshuaiz.com/wp-content/uploads/2014/02/coda_codekit.png"><img src="http://joshuaiz.com/wp-content/uploads/2014/02/coda_codekit.png" alt="coda_codekit" width="750" height="469" class="alignnone size-full wp-image-68" /></a></p>
";s:10:"post_title";s:21:"The Ultimate Workflow";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:21:"the-ultimate-workflow";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2014-04-04 20:04:55";s:17:"post_modified_gmt";s:19:"2014-04-05 01:04:55";s:21:"post_content_filtered";s:9077:"After working with Coda/Coda 2 and FTP for a few years, it was time to make a workflow upgrade. Don't get me wrong, Coda 2 is pretty amazing: my main Coda 2 window was fully customized to my liking, all my sites were organized, connecting to web servers was a breeze with FTP built-in and I had amassed a robust collection of snippets (err, "Clips" in Coda) that served me well. And no, I was not "going commando" as [Chris Coyier](http://css-tricks.com/deployment/) laments against — that is, working on the remote files directly. I always work on local versions of the file(s), do any precompiling of my Sass/SCSS in CodeKit and then would publish to the server in Coda 2 with a simple key command (see tip below). I used Tower for version control with GitHub and everything was fine and dandy.

But it *wasn't*. For one, even though my Coda 2/CodeKit workflow was pretty fast, I was still using the mouse (or trackpad as it were) way too much. All these little movements add up to hours and hours of wasted time. In addition, I knew I wasn't really using Git/GitHub properly. Yes, changes were being tracked, commits were being made and version control certainly saved my ass a few times but I knew there was way more to it. What's more, I was starting to get more into actual coding and needed a proper development environment that could make things easier and faster.

My requirements were as follows:

- do everything I could do in Coda 2: FTP, code snippets, command line
- publish to GitHub and to either a production or live server simultaneously
- have a properly set up development environment to start running code locally (like node.js)

Changes (and major ones) would have to be made but I was ready. I knew there would be a lot to learn but I was ready for that too. 

###Enter Sublime Text 3

Sublime Text 2 was not completely foreign to me — I had used it a few times but never really delved in fully until recently. This seemed like the perfect time to check it out in more detail. After spending a couple days with [Sublime Text 3](http://sublimetext.com/) and watching this great [tutorial](https://tutsplus.com/course/improve-workflow-in-sublime-text-2/) by Jeffrey Way at Tuts+, I finally got my head around it. **Holy Package Control!** **All of the things!** I was hooked.

ST3 is just so powerful it's mindblowing. With just a few plugins added through Package Control I'm already typing about half as much and that's just scratching the surface. There are so many things I wasn't using with Coda 2 that are simply indispensable to me now: Emmet (previously Zen Coding), Fetch, superior snippet integration, amazing Git support, Xiki — the list goes on. In ST3 these aren't just bells and whistles but tools that help you to not only code faster but code better. Just going through the process of getting ST3 set up changes the way you use your computer for other things. 

###Super Pro Workflow

Next it was time to set up Git + GitHub as well as my deployment location on the server so that I could keep everything in sync and do it all from ST3. This is assuming you have MAMP setup on your local machine and using WordPress.

**Here are the steps:**

1. Set up RSA key authentication on GitHub. From your account, go to Account Settings > Applications > Personal Access Token > Create new token.
2. Get [SublimeGit](https://sublimegit.net) with Package Control.
3. Create new local repo: `git init`
4. Make your first commit: `git commit -m "first commit"`
5. Set up your github remote repo: `git remote add origin https://github.com/joshuaiz/joshuaiz.git`
6. Push your local repo to GitHub: `git push -u remote origin master`
7. Then SSH to your web server location (in my case DreamHost)
8. Clone your repo: `git clone git://github.com/joshuaiz/joshuaiz.git`
9. Your site is now deployed!
10. Keeping it in sync is simple. In the git working directory on your web server, just create a php file with the following: <code><?php \`git pull\`;</code>
11. Then go to your repo on GitHub: http://github.com/youraccount/yourrepo.git > Settings > Webhooks & Services > Add Webhook and create a web hook with the URL to the php file you created in the previous step: http://yoursite.com/wp-content/themes/yourtheme/github.php. Now, whenever you push to your repo, GitHub will send a POST request to that file location which will keep your web server in perfect sync! Sweetness.

More info about these steps [here](http://www.blog.philiptutty.com/?p=67). There are lots of other deployment scripts out there with all kinds of configuration options but you really don't need any of those. The `git pull` file (in backtics) is a git command within a php file and that's all you really need to keep everything updated. Jeffery Way also mentions this in his Sublime Text tutorial. Note that you can do all of the Git steps from within ST3 using SublimeGit.

You might be saying what's the big deal here? In short, this changes everything.

Here was my workflow before:

- Install WordPress on a remote test domain
- Copy base theme files over using my fork of Bones - [Osseous](http://wearebio.com/osseous/) by dragging in Coda 2
- Drag files back to my local Sites/mysite/ folder
- Create local repo
- Create remote repo on GitHub
- Work on local files in Coda 2. Use CodeKit workaround (see below) for Coda 2 to see changed compiled Sass/SCSS files
- Publish to server with key command
- Switch from Coda 2 to browser; refresh browser
- Make changes in Chrome Dev Tools
- Copy changes in Chrome, update local files
- Rinse, repeat
- Use Tower to push changes to GitHub

And now:

- Set up local and GitHub remote repos
- Set up MAMP to work on files locally
- Add project to CodeKit (no workaround necessary). Set CodeKit to refresh local browser on save
- Work on local files
- Switch to browser and back to ST3 with Command-Tab (switch applications)
- Once ready to deploy, start from step 7 above
- Continue to work locally, push commits to GitHub using SublimeGit and use [SyncDB](https://github.com/jplew/SyncDB) with Xiki within ST3 (see below) and everything is synced: content, database, plugins, everything.

BOOM! This is so much faster. Just working locally saves so much time as your pages refresh pretty much instantly instead of waiting for a live server to reload. Again. And again.

**Content**: Just started playing around with this [SyncDB script](https://github.com/jplew/SyncDB) which can upload your local db to your web server and then automatically find/replace your local/live URLs. It also syncs your /uploads folder using `rsync`. When configured, you can upload and replace your WP db with a single command in Terminal: `./syncdb push` or `pull` to sync down. Absolutely amazing. If you've used the fantastic [Interconnectit db search and replace script](https://interconnectit.com/products/search-and-replace-for-wordpress-databases/), SyncDB has this built in. What's more, you can create a Xiki Buffer and run syncdb right from within ST3! This is a game changer.

###Final Thoughts

After working with this system for a few short days I could not be happier. I'll still use Coda 2 for quick updates of old projects but moving forward I will be using ST3 for everything. I'm sure there will be some tweaks so I'll post an update in a few weeks.

Now, if only I could settle on one of the many custom Sublime Text themes available, I may end up actually getting some work done. Speaking of which, if you'd like to create your own ST2/3 theme, here's a handy little Chrome app: [http://tmtheme-editor.herokuapp.com/](http://tmtheme-editor.herokuapp.com/). It's a little buggy and freezes up on occasion but it's fun to play around with. I've created a few derivitive themes and I'm getting closer to a perfect one.

>###Tip: Getting Coda 2 to see changes in your CodeKit compiled files
While Coda 2 + CodeKit work well together, Coda 2 doesn't recognize out of the box that CodeKit compiled files (for example Sass/LESS) have been changed and thus does not mark them as ready to be published. There is a workaround however:

>Navigate to your compiled files in Finder. In my case it was style.css and ie.css. Right-click on each CodeKit compiled file to show the contextual menu and go to Open With... Here you want to select CodeKit — it may not be in the menu so if not go down to "Other...". Navigate to /Applications/CodeKit.app and select it. CodeKit will give you a warning saying the file is already part of a project — just click OK. Do this for *each* compiled file and then Coda 2 will now see them as changed and ready to be published. In Coda 2 you can use Shift-Command-P to publish all changed files in one go. See image below to see the contextual menu for selecting the CodeKit app.

<a href="http://joshuaiz.com/wp-content/uploads/2014/02/coda_codekit.png"><img src="http://joshuaiz.com/wp-content/uploads/2014/02/coda_codekit.png" alt="coda_codekit" width="750" height="469" class="alignnone size-full wp-image-68" /></a>";s:11:"post_parent";s:1:"0";s:4:"guid";s:26:"http://joshuaiz:8888/?p=15";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}i:1;O:8:"stdClass":23:{s:2:"ID";s:3:"239";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-03-18 19:18:58";s:13:"post_date_gmt";s:19:"2014-03-19 00:18:58";s:12:"post_content";s:2081:"<p>After working on countless WordPress sites for clients and personal projects the situation that happened to me today never occurred before and I hope it never occurs again. Here's the deets:</p>

<p>Since I use 1Password to manage all my various web passwords, I never check the 'Remember Me' box on the WordPress login screen. Thus, after a couple hours of inactivity or if I change wifi networks I am logged out of the WordPress admin. Today I had a meeting with one of the clients I have been working with for a few years and I was checking a few things on their site before I left my house for the meeting.</p>

<p>Upon returning home I had been logged out of their site so I had to reauthenticate which I did. I happened to be on the Appearence > Menus page so when I logged back in I clicked 'Save Menu' just in case I had forgotten to do that before I was logged out. For whatever reason, WordPress did not like that at all.</p>

<p>When I went to check a few more things on the site, all of the main navigation menu items were titled 'admin' both on the front end and in the WP admin. What happened? This was new to me. Tried the obvious: re-saving, clearing my cache, clearing the site cachesbut no joy. With 10 top-level menu items, 12 sub menus and 4 sub-sub-menus I did not want to have to go in and rename all of these manually.</p>

<p>Did a quick Google search and this was one of those times where all of the search terms are too common to find anything useful: "wordpress nav menu items named admin" or "menu items changed to 'admin' wordpress" came up with pages and pages about WordPress nav menus, admin menus,changing menu item names and the like but I couldn't find any other example of my issue which in the mashup that is Google and WordPress is a very rare thing indeed.</p>

<p>Luckily for this client (and all my clients) I have daily database backups with BackupBuddy and was able to restore from yesterdays db and all is well - menus and WordPress equilibrium restored. But I'm stumped as to what exactly happened and how to avoid it next time.</p>
";s:10:"post_title";s:45:"A Funny Thing Happened in the WordPress Admin";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:45:"a-funny-thing-happened-in-the-wordpress-admin";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2014-05-14 18:36:55";s:17:"post_modified_gmt";s:19:"2014-05-14 23:36:55";s:21:"post_content_filtered";s:2049:"After working on countless WordPress sites for clients and personal projects the situation that happened to me today never occurred before and I hope it never occurs again. Here's the deets:

Since I use 1Password to manage all my various web passwords, I never check the 'Remember Me' box on the WordPress login screen. Thus, after a couple hours of inactivity or if I change wifi networks I am logged out of the WordPress admin. Today I had a meeting with one of the clients I have been working with for a few years and I was checking a few things on their site before I left my house for the meeting.

Upon returning home I had been logged out of their site so I had to reauthenticate which I did. I happened to be on the Appearence > Menus page so when I logged back in I clicked 'Save Menu' just in case I had forgotten to do that before I was logged out. For whatever reason, WordPress did not like that at all.

When I went to check a few more things on the site, all of the main navigation menu items were titled 'admin' both on the front end and in the WP admin. What happened? This was new to me. Tried the obvious: re-saving, clearing my cache, clearing the site cachesbut no joy. With 10 top-level menu items, 12 sub menus and 4 sub-sub-menus I did not want to have to go in and rename all of these manually. 

Did a quick Google search and this was one of those times where all of the search terms are too common to find anything useful: "wordpress nav menu items named admin" or "menu items changed to 'admin' wordpress" came up with pages and pages about WordPress nav menus, admin menus,changing menu item names and the like but I couldn't find any other example of my issue which in the mashup that is Google and WordPress is a very rare thing indeed.

Luckily for this client (and all my clients) I have daily database backups with BackupBuddy and was able to restore from yesterdays db and all is well - menus and WordPress equilibrium restored. But I'm stumped as to what exactly happened and how to avoid it next time.";s:11:"post_parent";s:1:"0";s:4:"guid";s:27:"http://joshuaiz:8888/?p=239";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}i:2;O:8:"stdClass":23:{s:2:"ID";s:3:"284";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2014-05-14 18:32:09";s:13:"post_date_gmt";s:19:"2014-05-14 23:32:09";s:12:"post_content";s:1610:"<p>One of the trickiest things about web development is coming up with an accurate estimate for projects. This is especially true for new developers without much experience. Accurate estimates are important for both the developer and the client: for the developer, an accurate estimate helps you schedule your time and figure out your profits; for clients, accurate estimates allow them to budget their time and money accordingly and avoid any gotcha moments down the road.</p>

<p>While every project is different, through experience I've stumbled upon a formula that seems to work for WordPress projects:</p>

<p>If <em>n</em> is the number of pages, and <em>N</em> is the number of hours:</p>

<p>(<em>n</em> x 2) + (<em>n</em> x 0.5) = <em>N</em></p>

<p>In other words, take the number of pages and double that. Add half the number of pages again and that number is the number of hours your WordPress project will take to develop. Mind you, there is absolutely nothing scientific about this but in my case it has proven to be remarkably accurate.</p>

<p>Now this assumes you are not entering any content except what is necessary to build out the page/post templates. If you have lots of jQuery and interactive features, you will need to tweak the formula a bit. For one page sites, especially ones that scroll down a lot, you can guestimate the equivalent amount of pages for a long home page.</p>

<p>Still, I've used this formula for the last year or so and if nothing else it can be a baseline to build your own estimate formula. Give it a try and let me know if it works for you in the comments.</p>
";s:10:"post_title";s:48:"Estimating WordPress project time for developers";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:48:"estimating-wordpress-project-time-for-developers";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2014-05-14 18:37:30";s:17:"post_modified_gmt";s:19:"2014-05-14 23:37:30";s:21:"post_content_filtered";s:1572:"One of the trickiest things about web development is coming up with an accurate estimate for projects. This is especially true for new developers without much experience. Accurate estimates are important for both the developer and the client: for the developer, an accurate estimate helps you schedule your time and figure out your profits; for clients, accurate estimates allow them to budget their time and money accordingly and avoid any gotcha moments down the road.

While every project is different, through experience I've stumbled upon a formula that seems to work for WordPress projects:

If <em>n</em> is the number of pages, and <em>N</em> is the number of hours:

(<em>n</em> x 2) + (<em>n</em> x 0.5) = <em>N</em>

In other words, take the number of pages and double that. Add half the number of pages again and that number is the number of hours your WordPress project will take to develop. Mind you, there is absolutely nothing scientific about this but in my case it has proven to be remarkably accurate.

Now this assumes you are not entering any content except what is necessary to build out the page/post templates. If you have lots of jQuery and interactive features, you will need to tweak the formula a bit. For one page sites, especially ones that scroll down a lot, you can guestimate the equivalent amount of pages for a long home page.

Still, I've used this formula for the last year or so and if nothing else it can be a baseline to build your own estimate formula. Give it a try and let me know if it works for you in the comments.";s:11:"post_parent";s:1:"0";s:4:"guid";s:27:"http://joshuaiz:8888/?p=284";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}s:8:"col_info";a:23:{i:0;O:8:"stdClass":13:{s:4:"name";s:2:"ID";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:3;s:8:"not_null";i:1;s:11:"primary_key";i:1;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:1;s:8:"zerofill";i:0;}i:1;O:8:"stdClass":13:{s:4:"name";s:11:"post_author";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:1;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:1;s:8:"zerofill";i:0;}i:2;O:8:"stdClass":13:{s:4:"name";s:9:"post_date";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:19;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:8:"datetime";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:3;O:8:"stdClass":13:{s:4:"name";s:13:"post_date_gmt";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:19;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:8:"datetime";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:4;O:8:"stdClass":13:{s:4:"name";s:12:"post_content";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:9739;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:5;O:8:"stdClass":13:{s:4:"name";s:10:"post_title";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:48;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:6;O:8:"stdClass":13:{s:4:"name";s:12:"post_excerpt";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:0;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:7;O:8:"stdClass":13:{s:4:"name";s:11:"post_status";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:7;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:8;O:8:"stdClass":13:{s:4:"name";s:14:"comment_status";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:6;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:9;O:8:"stdClass":13:{s:4:"name";s:11:"ping_status";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:6;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:10;O:8:"stdClass":13:{s:4:"name";s:13:"post_password";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:0;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:11;O:8:"stdClass":13:{s:4:"name";s:9:"post_name";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:48;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:12;O:8:"stdClass":13:{s:4:"name";s:7:"to_ping";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:0;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:13;O:8:"stdClass":13:{s:4:"name";s:6:"pinged";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:0;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:14;O:8:"stdClass":13:{s:4:"name";s:13:"post_modified";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:19;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:8:"datetime";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:15;O:8:"stdClass":13:{s:4:"name";s:17:"post_modified_gmt";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:19;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:8:"datetime";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:16;O:8:"stdClass":13:{s:4:"name";s:21:"post_content_filtered";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:9077;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:1;s:4:"type";s:4:"blob";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:17;O:8:"stdClass":13:{s:4:"name";s:11:"post_parent";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:1;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:1;s:8:"zerofill";i:0;}i:18;O:8:"stdClass":13:{s:4:"name";s:4:"guid";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:27;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:19;O:8:"stdClass":13:{s:4:"name";s:10:"menu_order";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:1;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:20;O:8:"stdClass":13:{s:4:"name";s:9:"post_type";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:4;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:1;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:21;O:8:"stdClass":13:{s:4:"name";s:14:"post_mime_type";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:0;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:0;s:4:"blob";i:0;s:4:"type";s:6:"string";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}i:22;O:8:"stdClass":13:{s:4:"name";s:13:"comment_count";s:5:"table";s:8:"wp_posts";s:3:"def";s:0:"";s:10:"max_length";i:1;s:8:"not_null";i:1;s:11:"primary_key";i:0;s:12:"multiple_key";i:0;s:10:"unique_key";i:0;s:7:"numeric";i:1;s:4:"blob";i:0;s:4:"type";s:3:"int";s:8:"unsigned";i:0;s:8:"zerofill";i:0;}}s:8:"num_rows";i:3;s:10:"return_val";i:3;}