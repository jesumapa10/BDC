<SCRIPT>
// general
var path                                        = "/intranet"

// tabs
var tab_font                                = "Tahoma"
var tab_width                                = ""
var up_arrow                                = "^ "
var show_parent                                = true
var show_sibs                                = false
var tab_color                                = "#000000"
var tab_font_color                        = "#FFFFFF"
var open_tab_color                        = "#6699FF"
var open_tab_font_color                        = "#FFFFFF"

// buttons
var button_font                                = "Tahoma"
var button_width                                = ""
var button_color                                = "#CCCCCC"
var button_font_color                        = "#3333CC"
var selected_button_color                = "#3333CC"
var selected_button_font_color        = "#FFFFFF"

// links
var splitter                                = ":"
var link_font                                = "Tahoma"
var splitter_color                        = "#3333CC"
var link_color                                = "#888888"

/*********************************************************************/

//FORMAT: path to page, page name, parent page name

links = new Array
(
 new link(path+"/modulo_iii/bdc_add_datos_instituciones.php",                "Datos Institucion",        "")
)

/*********************************************************************/

function link(path, name, parent)
{
 this.path = path
 this.name = name
 this.parent = parent
 this.props = new Array (path, name, parent)
}

/*********************************************************************/

function do_links(parent)
{
 var i=0

 var links_length = links.length;
 for(num=0; num<links.length; num++)
 {
  if(links[num].parent == parent)
  {
   if(i>0){
    document.writeln ("<font face='" + link_font + "' size=1 color='" + splitter_color + "'>" + splitter + "</font>")
   }
   document.writeln ("<a href='" + links[num].path + "' title='" + links[num].name + "'>")
   document.writeln ("<font face='" + link_font + "' size=1 color='" + link_color + "'>" + links[num].name + "</font></a>")
   i++
  }
 }
}

/*********************************************************************/

function do_tabs(section, page)
{
 var children = false
 var level = ""
 var links_length = links.length

 //find the parent of the current section
 for( num=0; num<links_length; num++){
  if (links[num].name == section){
   level = links[num].parent
  }
 }

 //create tabs
 document.writeln ("<table border=0 cellpadding=0 cellspacing=0><tr>")

 for( num=0; num<links_length; num++)
 {
  if(links[num].name == level || links[num].parent == level)
  {
   if (links[num].name == section) { bgcolor = open_tab_color; fntcolor = open_tab_font_color; }
   else { bgcolor = tab_color; fntcolor = tab_font_color; }

   if(links[num].name == level && show_parent)
   {
    document.writeln ("<td bgcolor='" + bgcolor + "' align='center' width=" + tab_width + "><nobr>")
    document.write   ("<font face='" + tab_font + "' size=2 color='" + fntcolor + "'>" + up_arrow + "</font>")
    document.write   ("<font size=2>&nbsp;&nbsp;</font>")
    document.write   ("<a href='" + links[num].path + "' title='" + links[num].name + "'>")
    document.write   ("<font face='" + tab_font + "' size=2 color='" + fntcolor + "'>" + links[num].name + "</font></a>")
    document.write   ("<font size=2>&nbsp;&nbsp;</font>")
    document.writeln ("</nobr></td>")
    document.writeln ("<td width=2></td>")
   }
   if(links[num].parent == level)
   {
    document.writeln ("<td bgcolor='" + bgcolor + "' align='center' width=" + tab_width + "><nobr>")
    document.write   ("<font size=2>&nbsp;&nbsp;</font>")
    document.write   ("<a href='" + links[num].path + "' title='" + links[num].name + "'>")
    document.write   ("<font face='" + tab_font + "' size=2 color='" + fntcolor + "'>" + links[num].name + "</font></a>")
    document.write   ("<font size=2>&nbsp;&nbsp;</font>")
    document.writeln ("</nobr></td>")
    document.writeln ("<td width=2></td>")
   }
  }
 }
 document.writeln ("</tr></table>")

 //create buttons
 document.writeln ("<table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td bgcolor='" + open_tab_color + "'>")
 document.writeln ("<table border=0 cellpadding=0 cellspacing=2><tr>")

 for(num=0; num<links_length; num++)
 {
  if(links[num].parent == section && section != "")
  {
   if (page == links[num].name) { bgcolor = selected_button_color; fntcolor = selected_button_font_color; }
   else { bgcolor = button_color; fntcolor = button_font_color; }
   document.writeln ("<td bgcolor='" + bgcolor + "' align='center' width=" + button_width + "><nobr>")
   document.write   ("<font size=2>&nbsp;&nbsp;</font>")
   document.write   ("<a href='" + links[num].path + "' title='" + links[num].name + "'>")
   document.write   ("<font face='" + button_font + "' size=2 color='" + fntcolor + "'>" + links[num].name + "</font></a>")
   document.write   ("<font size=2>&nbsp;&nbsp;</font>")
   document.writeln ("</nobr></td>")
   children = true
  }
 }
 if(! children) document.writeln ("<td></td>")
 document.writeln ("</tr></table>")
 document.writeln ("</td></tr></table>")
}
</SCRIPT>
