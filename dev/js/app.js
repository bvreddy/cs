// window.onload = function() {
//     window.ShapesPolyfill.run();
// }





// (function() {
//     tinymce.create('tinymce.plugins.quote', {
//         init : function(ed, url) {
//             ed.addButton('quote', {
//                 title : 'Add a Quote',
//                 image : url+'/image.png',
//                 onclick : function() {
//                      ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]');
 
//                 }
//             });
//         },
//         createControl : function(n, cm) {
//             return null;
//         },
//     });
//     tinymce.PluginManager.add('quote', tinymce.plugins.quote);
// })();



(function() {
    tinymce.create('tinymce.plugins.recentposts', {
       init : function(ed, url) {
          ed.addButton('recentposts', {
             title : 'Recent posts',
             image : url+'/recentpostsbutton.png',
             onclick : function() {
                var posts = prompt("Number of posts", "1");
                var text = prompt("List Heading", "This is the heading text");
 
                if (text != null && text != ''){
                   if (posts != null && posts != '')
                      ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]'+text+'[/recent-posts]');
                   else
                      ed.execCommand('mceInsertContent', false, '[recent-posts]'+text+'[/recent-posts]');
                }
                else{
                   if (posts != null && posts != '')
                      ed.execCommand('mceInsertContent', false, '[recent-posts posts="'+posts+'"]');
                   else
                      ed.execCommand('mceInsertContent', false, '[recent-posts]');
                }
             }
          });
       },
       createControl : function(n, cm) {
          return null;
       },
       getInfo : function() {
          return {
             longname : "Recent Posts",
             author : 'Konstantinos Kouratoras',
             authorurl : 'http://www.kouratoras.gr',
             infourl : '',
             version : "1.0"
          };
       }
    });
    tinymce.PluginManager.add('recentposts', tinymce.plugins.recentposts);
 })();

 