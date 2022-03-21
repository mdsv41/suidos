
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title>DataTables example - Alternative pagination</title>
  <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=8ffc0b31bc8d9ff82fbb94689dd1d7ff">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <style type="text/css" class="init">

  </style>
  <script type="text/javascript" src="/media/js/site.js?_=994321fabf3873df746bb8bbccd1886a"></script>
  <script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Falt_pagination.html" async></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  <script type="text/javascript" class="init">

      $(document).ready(function() {
          $('#example').DataTable( {
              "pagingType": "full_numbers"
          } );
      } );

  </script>
</head>
<body class="wide comments example">
<a name="top" id="top"></a>
<div class="fw-background">
  <div></div>
</div>
<div class="fw-container">
  <div class="fw-header">
    <div class="nav-master">
      <div class="nav-item active">
        <a href="/">DataTables</a>
      </div>
      <div class="nav-item">
        <a href="//editor.datatables.net">Editor</a>
      </div>
    </div>
    <div class="nav-search">
      <div class="nav-item i-manual">
        <a href="/manual">Manual</a>
      </div>
      <div class="nav-item i-download">
        <a href="/download">Download</a>
      </div>
      <div class="nav-item i-user">
        <div class="account"></div>
      </div>
      <div class="nav-item search">
        <form action="/q/" method="get">
          <input type="text" name="q" placeholder="Search . . ." autocomplete="off">
        </form>
      </div>
    </div>
  </div>
  <div class="fw-nav">
    <div class="nav-main">
      <ul>
        <li class="sub-active sub">
          <a href="/examples/index">Examples</a>
          <ul>
            <li class="active"><a href="/examples/basic_init">Basic initialisation</a></li>
            <li class=""><a href="/examples/advanced_init">Advanced initialisation</a></li>
            <li class=""><a href="/examples/styling">Styling</a></li>
            <li class=""><a href="/examples/data_sources">Data sources</a></li>
            <li class=""><a href="/examples/api">API</a></li>
            <li class=""><a href="/examples/ajax">Ajax</a></li>
            <li class=""><a href="/examples/server_side">Server-side</a></li>
            <li class=""><a href="/examples/plug-ins">Plug-ins</a></li>
          </ul>
        </li>
        <li class=" sub"><a href="/manual/index">Manual</a></li>
        <li class=" sub"><a href="/reference/index">Reference</a></li>
        <li class=" sub"><a href="/extensions/index">Extensions</a></li>
        <li class=" sub"><a href="/plug-ins/index">Plug-ins</a></li>
        <li class=""><a href="/blog/index">Blog</a></li>
        <li class=""><a href="/forums/index">Forums</a></li>
        <li class=""><a href="/support/index">Support</a></li>
        <li class=""><a href="/faqs/index">FAQs</a></li>
        <li class=""><a href="/download/index">Download</a></li>
        <li class=""><a href="/purchase/index">Purchase</a></li>
      </ul>
    </div>
    <div class="mobile-show">
      <a><i>Show site navigation</i></a>
    </div>
  </div>
  <div class="fw-body">
    <div class="content">
      <h1 class="page_title">Alternative pagination</h1>
      <div class="info">
        <p>The default page control presented by DataTables (forward and backward buttons with up to 7 page numbers in-between) is fine for most situations, but there
          are cases where you may wish to customise the options presented to the end user. This is done through DataTables' extensible pagination mechanism, the <a href=
                                                                                                                                                                    "//datatables.net/reference/option/pagingType"><code class="option" title="DataTables initialisation option">pagingType</code></a> option.</p>
        <p>There are six built-in options for which pagination controls DataTables should show:</p>
        <ul class="markdown">
          <li><code class="string" title="String">numbers</code> - Page number buttons only</li>
          <li><code class="string" title="String">simple</code> - 'Previous' and 'Next' buttons only</li>
          <li><code class="string" title="String">simple_numbers</code> - 'Previous' and 'Next' buttons, plus page numbers</li>
          <li><code class="string" title="String">full</code> - 'First', 'Previous', 'Next' and 'Last' buttons</li>
          <li><code class="string" title="String">full_numbers</code> - 'First', 'Previous', 'Next' and 'Last' buttons, plus page numbers</li>
          <li><code class="string" title="String">first_last_numbers</code> - 'First' and 'Last' buttons, plus page numbers</li>
        </ul>
        <p>The language strings of 'First', 'Previous' etc can be optionally changed through the internationalisation options of DataTables; <a href=
                                                                                                                                                "//datatables.net/reference/option/language.paginate.first"><code class="option" title="DataTables initialisation option">language.paginate.first</code></a>,
          <a href="//datatables.net/reference/option/language.paginate.previous"><code class="option" title=
            "DataTables initialisation option">language.paginate.previous</code></a> etc.</p>
        <p>Additional options for the buttons that are shown can be added through the use of pagination type plug-ins. Furthermore, how the buttons are actually shown
          can be altered through the use of plug-in pagination renderers.</p>
        <p>The example below shows the <code class="string" title="String">full_numbers</code> type of pagination.</p>
      </div>
      <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Age</th>
          <th>Start date</th>
          <th>Salary</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Tiger Nixon</td>
          <td>System Architect</td>
          <td>Edinburgh</td>
          <td>61</td>
          <td>2011/04/25</td>
          <td>$320,800</td>
        </tr>
        <tr>
          <td>Garrett Winters</td>
          <td>Accountant</td>
          <td>Tokyo</td>
          <td>63</td>
          <td>2011/07/25</td>
          <td>$170,750</td>
        </tr>
        <tr>
          <td>Ashton Cox</td>
          <td>Junior Technical Author</td>
          <td>San Francisco</td>
          <td>66</td>
          <td>2009/01/12</td>
          <td>$86,000</td>
        </tr>
        <tr>
          <td>Cedric Kelly</td>
          <td>Senior Javascript Developer</td>
          <td>Edinburgh</td>
          <td>22</td>
          <td>2012/03/29</td>
          <td>$433,060</td>
        </tr>
        <tr>
          <td>Airi Satou</td>
          <td>Accountant</td>
          <td>Tokyo</td>
          <td>33</td>
          <td>2008/11/28</td>
          <td>$162,700</td>
        </tr>
        <tr>
          <td>Brielle Williamson</td>
          <td>Integration Specialist</td>
          <td>New York</td>
          <td>61</td>
          <td>2012/12/02</td>
          <td>$372,000</td>
        </tr>
        <tr>
          <td>Herrod Chandler</td>
          <td>Sales Assistant</td>
          <td>San Francisco</td>
          <td>59</td>
          <td>2012/08/06</td>
          <td>$137,500</td>
        </tr>
        <tr>
          <td>Rhona Davidson</td>
          <td>Integration Specialist</td>
          <td>Tokyo</td>
          <td>55</td>
          <td>2010/10/14</td>
          <td>$327,900</td>
        </tr>
        <tr>
          <td>Colleen Hurst</td>
          <td>Javascript Developer</td>
          <td>San Francisco</td>
          <td>39</td>
          <td>2009/09/15</td>
          <td>$205,500</td>
        </tr>
        <tr>
          <td>Sonya Frost</td>
          <td>Software Engineer</td>
          <td>Edinburgh</td>
          <td>23</td>
          <td>2008/12/13</td>
          <td>$103,600</td>
        </tr>
        <tr>
          <td>Jena Gaines</td>
          <td>Office Manager</td>
          <td>London</td>
          <td>30</td>
          <td>2008/12/19</td>
          <td>$90,560</td>
        </tr>
        <tr>
          <td>Quinn Flynn</td>
          <td>Support Lead</td>
          <td>Edinburgh</td>
          <td>22</td>
          <td>2013/03/03</td>
          <td>$342,000</td>
        </tr>
        <tr>
          <td>Charde Marshall</td>
          <td>Regional Director</td>
          <td>San Francisco</td>
          <td>36</td>
          <td>2008/10/16</td>
          <td>$470,600</td>
        </tr>
        <tr>
          <td>Haley Kennedy</td>
          <td>Senior Marketing Designer</td>
          <td>London</td>
          <td>43</td>
          <td>2012/12/18</td>
          <td>$313,500</td>
        </tr>
        <tr>
          <td>Tatyana Fitzpatrick</td>
          <td>Regional Director</td>
          <td>London</td>
          <td>19</td>
          <td>2010/03/17</td>
          <td>$385,750</td>
        </tr>
        <tr>
          <td>Michael Silva</td>
          <td>Marketing Designer</td>
          <td>London</td>
          <td>66</td>
          <td>2012/11/27</td>
          <td>$198,500</td>
        </tr>
        <tr>
          <td>Paul Byrd</td>
          <td>Chief Financial Officer (CFO)</td>
          <td>New York</td>
          <td>64</td>
          <td>2010/06/09</td>
          <td>$725,000</td>
        </tr>
        <tr>
          <td>Gloria Little</td>
          <td>Systems Administrator</td>
          <td>New York</td>
          <td>59</td>
          <td>2009/04/10</td>
          <td>$237,500</td>
        </tr>
        <tr>
          <td>Bradley Greer</td>
          <td>Software Engineer</td>
          <td>London</td>
          <td>41</td>
          <td>2012/10/13</td>
          <td>$132,000</td>
        </tr>
        <tr>
          <td>Dai Rios</td>
          <td>Personnel Lead</td>
          <td>Edinburgh</td>
          <td>35</td>
          <td>2012/09/26</td>
          <td>$217,500</td>
        </tr>
        <tr>
          <td>Jenette Caldwell</td>
          <td>Development Lead</td>
          <td>New York</td>
          <td>30</td>
          <td>2011/09/03</td>
          <td>$345,000</td>
        </tr>
        <tr>
          <td>Yuri Berry</td>
          <td>Chief Marketing Officer (CMO)</td>
          <td>New York</td>
          <td>40</td>
          <td>2009/06/25</td>
          <td>$675,000</td>
        </tr>
        <tr>
          <td>Caesar Vance</td>
          <td>Pre-Sales Support</td>
          <td>New York</td>
          <td>21</td>
          <td>2011/12/12</td>
          <td>$106,450</td>
        </tr>
        <tr>
          <td>Doris Wilder</td>
          <td>Sales Assistant</td>
          <td>Sidney</td>
          <td>23</td>
          <td>2010/09/20</td>
          <td>$85,600</td>
        </tr>
        <tr>
          <td>Angelica Ramos</td>
          <td>Chief Executive Officer (CEO)</td>
          <td>London</td>
          <td>47</td>
          <td>2009/10/09</td>
          <td>$1,200,000</td>
        </tr>
        <tr>
          <td>Gavin Joyce</td>
          <td>Developer</td>
          <td>Edinburgh</td>
          <td>42</td>
          <td>2010/12/22</td>
          <td>$92,575</td>
        </tr>
        <tr>
          <td>Jennifer Chang</td>
          <td>Regional Director</td>
          <td>Singapore</td>
          <td>28</td>
          <td>2010/11/14</td>
          <td>$357,650</td>
        </tr>
        <tr>
          <td>Brenden Wagner</td>
          <td>Software Engineer</td>
          <td>San Francisco</td>
          <td>28</td>
          <td>2011/06/07</td>
          <td>$206,850</td>
        </tr>
        <tr>
          <td>Fiona Green</td>
          <td>Chief Operating Officer (COO)</td>
          <td>San Francisco</td>
          <td>48</td>
          <td>2010/03/11</td>
          <td>$850,000</td>
        </tr>
        <tr>
          <td>Shou Itou</td>
          <td>Regional Marketing</td>
          <td>Tokyo</td>
          <td>20</td>
          <td>2011/08/14</td>
          <td>$163,000</td>
        </tr>
        <tr>
          <td>Michelle House</td>
          <td>Integration Specialist</td>
          <td>Sidney</td>
          <td>37</td>
          <td>2011/06/02</td>
          <td>$95,400</td>
        </tr>
        <tr>
          <td>Suki Burks</td>
          <td>Developer</td>
          <td>London</td>
          <td>53</td>
          <td>2009/10/22</td>
          <td>$114,500</td>
        </tr>
        <tr>
          <td>Prescott Bartlett</td>
          <td>Technical Author</td>
          <td>London</td>
          <td>27</td>
          <td>2011/05/07</td>
          <td>$145,000</td>
        </tr>
        <tr>
          <td>Gavin Cortez</td>
          <td>Team Leader</td>
          <td>San Francisco</td>
          <td>22</td>
          <td>2008/10/26</td>
          <td>$235,500</td>
        </tr>
        <tr>
          <td>Martena Mccray</td>
          <td>Post-Sales support</td>
          <td>Edinburgh</td>
          <td>46</td>
          <td>2011/03/09</td>
          <td>$324,050</td>
        </tr>
        <tr>
          <td>Unity Butler</td>
          <td>Marketing Designer</td>
          <td>San Francisco</td>
          <td>47</td>
          <td>2009/12/09</td>
          <td>$85,675</td>
        </tr>
        <tr>
          <td>Howard Hatfield</td>
          <td>Office Manager</td>
          <td>San Francisco</td>
          <td>51</td>
          <td>2008/12/16</td>
          <td>$164,500</td>
        </tr>
        <tr>
          <td>Hope Fuentes</td>
          <td>Secretary</td>
          <td>San Francisco</td>
          <td>41</td>
          <td>2010/02/12</td>
          <td>$109,850</td>
        </tr>
        <tr>
          <td>Vivian Harrell</td>
          <td>Financial Controller</td>
          <td>San Francisco</td>
          <td>62</td>
          <td>2009/02/14</td>
          <td>$452,500</td>
        </tr>
        <tr>
          <td>Timothy Mooney</td>
          <td>Office Manager</td>
          <td>London</td>
          <td>37</td>
          <td>2008/12/11</td>
          <td>$136,200</td>
        </tr>
        <tr>
          <td>Jackson Bradshaw</td>
          <td>Director</td>
          <td>New York</td>
          <td>65</td>
          <td>2008/09/26</td>
          <td>$645,750</td>
        </tr>
        <tr>
          <td>Olivia Liang</td>
          <td>Support Engineer</td>
          <td>Singapore</td>
          <td>64</td>
          <td>2011/02/03</td>
          <td>$234,500</td>
        </tr>
        <tr>
          <td>Bruno Nash</td>
          <td>Software Engineer</td>
          <td>London</td>
          <td>38</td>
          <td>2011/05/03</td>
          <td>$163,500</td>
        </tr>
        <tr>
          <td>Sakura Yamamoto</td>
          <td>Support Engineer</td>
          <td>Tokyo</td>
          <td>37</td>
          <td>2009/08/19</td>
          <td>$139,575</td>
        </tr>
        <tr>
          <td>Thor Walton</td>
          <td>Developer</td>
          <td>New York</td>
          <td>61</td>
          <td>2013/08/11</td>
          <td>$98,540</td>
        </tr>
        <tr>
          <td>Finn Camacho</td>
          <td>Support Engineer</td>
          <td>San Francisco</td>
          <td>47</td>
          <td>2009/07/07</td>
          <td>$87,500</td>
        </tr>
        <tr>
          <td>Serge Baldwin</td>
          <td>Data Coordinator</td>
          <td>Singapore</td>
          <td>64</td>
          <td>2012/04/09</td>
          <td>$138,575</td>
        </tr>
        <tr>
          <td>Zenaida Frank</td>
          <td>Software Engineer</td>
          <td>New York</td>
          <td>63</td>
          <td>2010/01/04</td>
          <td>$125,250</td>
        </tr>
        <tr>
          <td>Zorita Serrano</td>
          <td>Software Engineer</td>
          <td>San Francisco</td>
          <td>56</td>
          <td>2012/06/01</td>
          <td>$115,000</td>
        </tr>
        <tr>
          <td>Jennifer Acosta</td>
          <td>Junior Javascript Developer</td>
          <td>Edinburgh</td>
          <td>43</td>
          <td>2013/02/01</td>
          <td>$75,650</td>
        </tr>
        <tr>
          <td>Cara Stevens</td>
          <td>Sales Assistant</td>
          <td>New York</td>
          <td>46</td>
          <td>2011/12/06</td>
          <td>$145,600</td>
        </tr>
        <tr>
          <td>Hermione Butler</td>
          <td>Regional Director</td>
          <td>London</td>
          <td>47</td>
          <td>2011/03/21</td>
          <td>$356,250</td>
        </tr>
        <tr>
          <td>Lael Greer</td>
          <td>Systems Administrator</td>
          <td>London</td>
          <td>21</td>
          <td>2009/02/27</td>
          <td>$103,500</td>
        </tr>
        <tr>
          <td>Jonas Alexander</td>
          <td>Developer</td>
          <td>San Francisco</td>
          <td>30</td>
          <td>2010/07/14</td>
          <td>$86,500</td>
        </tr>
        <tr>
          <td>Shad Decker</td>
          <td>Regional Director</td>
          <td>Edinburgh</td>
          <td>51</td>
          <td>2008/11/13</td>
          <td>$183,000</td>
        </tr>
        <tr>
          <td>Michael Bruce</td>
          <td>Javascript Developer</td>
          <td>Singapore</td>
          <td>29</td>
          <td>2011/06/27</td>
          <td>$183,000</td>
        </tr>
        <tr>
          <td>Donna Snider</td>
          <td>Customer Support</td>
          <td>New York</td>
          <td>27</td>
          <td>2011/01/25</td>
          <td>$112,000</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Age</th>
          <th>Start date</th>
          <th>Salary</th>
        </tr>
        </tfoot>
      </table>
      <ul class="tabs">
        <li class="active">Javascript</li>
        <li>HTML</li>
        <li>CSS</li>
        <li>Ajax</li>
        <li>Server-side script</li>
        <li class="comment-count">Comments</li>
      </ul>
      <div class="tabs">
        <div class="js">
          <p>The Javascript shown below is used to initialise the table shown in this example:</p><code class="multiline language-js">$(document).ready(function() {
            $('#example').DataTable( {
            &quot;pagingType&quot;: &quot;full_numbers&quot;
            } );
            } );</code>
          <p>In addition to the above code, the following Javascript library files are loaded for use in this example:</p>
          <ul>
            <li>
              <a href="https://code.jquery.com/jquery-3.3.1.js">https://code.jquery.com/jquery-3.3.1.js</a>
            </li>
            <li>
              <a href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js</a>
            </li>
          </ul>
        </div>
        <div class="table">
          <p>The HTML shown below is the raw HTML table element, before it has been enhanced by DataTables:</p>
        </div>
        <div class="css">
          <div>
            <p>This example uses a little bit of additional CSS beyond what is loaded from the library files (below), in order to correctly display the table. The
              additional CSS used is shown below:</p><code class="multiline language-css"></code>
          </div>
          <p>The following CSS library files are loaded for use in this example to provide the styling of the table:</p>
          <ul>
            <li>
              <a href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css</a>
            </li>
          </ul>
        </div>
        <div class="ajax">
          <p>This table loads data by Ajax. The latest data that has been loaded is shown below. This data will update automatically as any additional data is
            loaded.</p>
        </div>
        <div class="php">
          <p>The script used to perform the server-side processing for this table is shown below. Please note that this is just an example script using PHP.
            Server-side processing scripts can be written in any language, using <a href="//datatables.net/manual/server-side">the protocol described in the DataTables
              documentation</a>.</p>
        </div>
        <div class="comments">
          <div class="comments-insert"></div>
        </div>
      </div>
      <h2>Other examples</h2>
      <div class="toc">
        <div class="toc-group">
          <h3><a href="./index.html">Basic initialisation</a></h3>
          <ul class="toc active">
            <li>
              <a href="./zero_configuration.html">Zero configuration</a>
            </li>
            <li>
              <a href="./filter_only.html">Feature enable / disable</a>
            </li>
            <li>
              <a href="./table_sorting.html">Default ordering (sorting)</a>
            </li>
            <li>
              <a href="./multi_col_sort.html">Multi-column ordering</a>
            </li>
            <li>
              <a href="./multiple_tables.html">Multiple tables</a>
            </li>
            <li>
              <a href="./hidden_columns.html">Hidden columns</a>
            </li>
            <li>
              <a href="./complex_header.html">Complex headers (rowspan and colspan)</a>
            </li>
            <li>
              <a href="./dom.html">DOM positioning</a>
            </li>
            <li>
              <a href="./flexible_width.html">Flexible table width</a>
            </li>
            <li>
              <a href="./state_save.html">State saving</a>
            </li>
            <li class="active">
              <a href="./alt_pagination.html">Alternative pagination</a>
            </li>
            <li>
              <a href="./scroll_y.html">Scroll - vertical</a>
            </li>
            <li>
              <a href="./scroll_y_dynamic.html">Scroll - vertical, dynamic height</a>
            </li>
            <li>
              <a href="./scroll_x.html">Scroll - horizontal</a>
            </li>
            <li>
              <a href="./scroll_xy.html">Scroll - horizontal and vertical</a>
            </li>
            <li>
              <a href="./comma-decimal.html">Language - Comma decimal place</a>
            </li>
            <li>
              <a href="./language.html">Language options</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../advanced_init/index.html">Advanced initialisation</a></h3>
          <ul class="toc">
            <li>
              <a href="../advanced_init/events_live.html">DOM / jQuery events</a>
            </li>
            <li>
              <a href="../advanced_init/dt_events.html">DataTables events</a>
            </li>
            <li>
              <a href="../advanced_init/column_render.html">Column rendering</a>
            </li>
            <li>
              <a href="../advanced_init/length_menu.html">Page length options</a>
            </li>
            <li>
              <a href="../advanced_init/dom_multiple_elements.html">Multiple table control elements</a>
            </li>
            <li>
              <a href="../advanced_init/complex_header.html">Complex headers with column visibility</a>
            </li>
            <li>
              <a href="../advanced_init/object_dom_read.html">Read HTML to data objects</a>
            </li>
            <li>
              <a href="../advanced_init/html5-data-options.html">HTML5 data-* attributes - table options</a>
            </li>
            <li>
              <a href="../advanced_init/html5-data-attributes.html">HTML5 data-* attributes - cell data</a>
            </li>
            <li>
              <a href="../advanced_init/language_file.html">Language file</a>
            </li>
            <li>
              <a href="../advanced_init/defaults.html">Setting defaults</a>
            </li>
            <li>
              <a href="../advanced_init/row_callback.html">Row created callback</a>
            </li>
            <li>
              <a href="../advanced_init/row_grouping.html">Row grouping</a>
            </li>
            <li>
              <a href="../advanced_init/footer_callback.html">Footer callback</a>
            </li>
            <li>
              <a href="../advanced_init/dom_toolbar.html">Custom toolbar elements</a>
            </li>
            <li>
              <a href="../advanced_init/sort_direction_control.html">Order direction sequence control</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../styling/index.html">Styling</a></h3>
          <ul class="toc">
            <li>
              <a href="../styling/display.html">Base style</a>
            </li>
            <li>
              <a href="../styling/no-classes.html">Base style - no styling classes</a>
            </li>
            <li>
              <a href="../styling/cell-border.html">Base style - cell borders</a>
            </li>
            <li>
              <a href="../styling/compact.html">Base style - compact</a>
            </li>
            <li>
              <a href="../styling/hover.html">Base style - hover</a>
            </li>
            <li>
              <a href="../styling/order-column.html">Base style - order-column</a>
            </li>
            <li>
              <a href="../styling/row-border.html">Base style - row borders</a>
            </li>
            <li>
              <a href="../styling/stripe.html">Base style - stripe</a>
            </li>
            <li>
              <a href="../styling/bootstrap.html">Bootstrap 3</a>
            </li>
            <li>
              <a href="../styling/bootstrap4.html">Bootstrap 4</a>
            </li>
            <li>
              <a href="../styling/foundation.html">Foundation</a>
            </li>
            <li>
              <a href="../styling/semanticui.html">Semantic UI</a>
            </li>
            <li>
              <a href="../styling/jqueryUI.html">jQuery UI ThemeRoller</a>
            </li>
            <li>
              <a href="../styling/material.html">Material Design (Tech. preview)</a>
            </li>
            <li>
              <a href="../styling/uikit.html">UIKit 3 (Tech. preview)</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../data_sources/index.html">Data sources</a></h3>
          <ul class="toc">
            <li>
              <a href="../data_sources/dom.html">HTML (DOM) sourced data</a>
            </li>
            <li>
              <a href="../data_sources/ajax.html">Ajax sourced data</a>
            </li>
            <li>
              <a href="../data_sources/js_array.html">Javascript sourced data</a>
            </li>
            <li>
              <a href="../data_sources/server_side.html">Server-side processing</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../api/index.html">API</a></h3>
          <ul class="toc">
            <li>
              <a href="../api/add_row.html">Add rows</a>
            </li>
            <li>
              <a href="../api/multi_filter.html">Individual column searching (text inputs)</a>
            </li>
            <li>
              <a href="../api/multi_filter_select.html">Individual column searching (select inputs)</a>
            </li>
            <li>
              <a href="../api/highlight.html">Highlighting rows and columns</a>
            </li>
            <li>
              <a href="../api/row_details.html">Child rows (show extra / detailed information)</a>
            </li>
            <li>
              <a href="../api/select_row.html">Row selection (multiple rows)</a>
            </li>
            <li>
              <a href="../api/select_single_row.html">Row selection and deletion (single row)</a>
            </li>
            <li>
              <a href="../api/form.html">Form inputs</a>
            </li>
            <li>
              <a href="../api/counter_columns.html">Index column</a>
            </li>
            <li>
              <a href="../api/show_hide.html">Show / hide columns dynamically</a>
            </li>
            <li>
              <a href="../api/api_in_init.html">Using API in callbacks</a>
            </li>
            <li>
              <a href="../api/tabs_and_scrolling.html">Scrolling and Bootstrap tabs</a>
            </li>
            <li>
              <a href="../api/regex.html">Search API (regular expressions)</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../ajax/index.html">Ajax</a></h3>
          <ul class="toc">
            <li>
              <a href="../ajax/simple.html">Ajax data source (arrays)</a>
            </li>
            <li>
              <a href="../ajax/objects.html">Ajax data source (objects)</a>
            </li>
            <li>
              <a href="../ajax/deep.html">Nested object data (objects)</a>
            </li>
            <li>
              <a href="../ajax/objects_subarrays.html">Nested object data (arrays)</a>
            </li>
            <li>
              <a href="../ajax/orthogonal-data.html">Orthogonal data</a>
            </li>
            <li>
              <a href="../ajax/null_data_source.html">Generated content for a column</a>
            </li>
            <li>
              <a href="../ajax/custom_data_property.html">Custom data source property</a>
            </li>
            <li>
              <a href="../ajax/custom_data_flat.html">Flat array data source</a>
            </li>
            <li>
              <a href="../ajax/defer_render.html">Deferred rendering for speed</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../server_side/index.html">Server-side</a></h3>
          <ul class="toc">
            <li>
              <a href="../server_side/simple.html">Server-side processing</a>
            </li>
            <li>
              <a href="../server_side/custom_vars.html">Custom HTTP variables</a>
            </li>
            <li>
              <a href="../server_side/post.html">POST data</a>
            </li>
            <li>
              <a href="../server_side/ids.html">Automatic addition of row ID attributes</a>
            </li>
            <li>
              <a href="../server_side/object_data.html">Object data source</a>
            </li>
            <li>
              <a href="../server_side/row_details.html">Row details</a>
            </li>
            <li>
              <a href="../server_side/select_rows.html">Row selection</a>
            </li>
            <li>
              <a href="../server_side/jsonp.html">JSONP data source for remote domains</a>
            </li>
            <li>
              <a href="../server_side/defer_loading.html">Deferred loading of data</a>
            </li>
            <li>
              <a href="../server_side/pipeline.html">Pipelining data to reduce Ajax calls for paging</a>
            </li>
          </ul>
        </div>
        <div class="toc-group">
          <h3><a href="../plug-ins/index.html">Plug-ins</a></h3>
          <ul class="toc">
            <li>
              <a href="../plug-ins/api.html">API plug-in methods</a>
            </li>
            <li>
              <a href="../plug-ins/sorting_auto.html">Ordering plug-ins (with type detection)</a>
            </li>
            <li>
              <a href="../plug-ins/sorting_manual.html">Ordering plug-ins (no type detection)</a>
            </li>
            <li>
              <a href="../plug-ins/range_filtering.html">Custom filtering - range search</a>
            </li>
            <li>
              <a href="../plug-ins/dom_sort.html">Live DOM ordering</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="fw-footer">
  <div class="skew"></div>
  <div class="skew-bg"></div>
  <div class="copyright">
    <h4>DataTables</h4>
    <p>DataTables designed and created by <a href="//sprymedia.co.uk">SpryMedia Ltd</a>.<br>
      © 2007-2019 <a href="/license/mit">MIT licensed</a>. <a href="/privacy">Privacy policy</a>. <a href="/supporters">Supporters</a>.<br>
      SpryMedia Ltd is registered in Scotland, company no. SC456502.</p>
  </div>
</div>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-365466-5']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
</body>
</html>