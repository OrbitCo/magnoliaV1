<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pool.twig */
class __TwigTemplate_098da9b23016b04630fc6e2851fece6212fa7dba56fc489a37a0a9b79a3926f0 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->loadTemplate("@app/header.twig", "pool.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 6
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_notifications_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 7
        echo "            </ul>
        </div>

        <div class=\"x_content\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <a id=\"refresh\" class=\"pool_link btn btn-default\">
                    ";
        // line 13
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("refresh_pool"        ,"notifications"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 14
        echo "                </a>
                ";
        // line 15
        if (($context["allow_pool_send"] ?? null)) {
            // line 16
            echo "                    <a id=\"send\" class=\"pool_link btn btn-default\">
                        ";
            // line 17
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("send_pools"            ,"notifications"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 18
            echo "                    </a>
                ";
        }
        // line 20
        echo "                ";
        if (($context["allow_pool_delete"] ?? null)) {
            // line 21
            echo "                    <a id=\"delete\" class=\"pool_link btn btn-default\">
                        ";
            // line 22
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("delete_pools"            ,"notifications"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 23
            echo "                    </a>
                ";
        }
        // line 25
        echo "            </div>
            <div class=\"clearfix\"></div>
        </div>

        <form method=\"post\" action=\"";
        // line 29
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" id=\"pool_form\" name=\"pool_form\" enctype=\"multipart/form-data\"
              class=\"form-horizontal form-label-left\">
            <div id=\"pool_data\">
                <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table\">
                    <thead>
                        <tr class=\"headings\">
                            ";
        // line 35
        if ((($context["allow_pool_send"] ?? null) || ($context["allow_pool_delete"] ?? null))) {
            // line 36
            echo "                                <th class=\"column-group\"><input type=\"checkbox\" id=\"check-all\" class=\"flat\"></th>
                            ";
        }
        // line 38
        echo "                            <th class=\"column-title text-center ";
        if (( !($context["allow_pool_send"] ?? null) &&  !($context["allow_pool_delete"] ?? null))) {
            echo "first";
        }
        echo "\">
                                ";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_mail_to_email"        ,"notifications"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 40
        echo "                            </th>
                            <th class=\"column-title text-center\">
                                ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_subject"        ,"notifications"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 43
        echo "                            </th>
                            <th class=\"column-title text-center\">
                                ";
        // line 45
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("send_attempts"        ,"notifications"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 46
        echo "                            </th>
                            ";
        // line 47
        if ((($context["allow_pool_send"] ?? null) || ($context["allow_pool_delete"] ?? null))) {
            // line 48
            echo "                                <th class=\"column-title text-center\">
                                    ";
            // line 49
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("actions"            ,"notifications"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 50
            echo "                                </th>
                            ";
        }
        // line 52
        echo "                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["senders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 56
            echo "                            <tr class=\"even pointer\">
                                ";
            // line 57
            if ((($context["allow_pool_send"] ?? null) || ($context["allow_pool_delete"] ?? null))) {
                // line 58
                echo "                                    <td class=\"first w20 center\">
                                        <input type=\"checkbox\" class=\"grouping flat\" value=\"";
                // line 59
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                    </td>
                                ";
            }
            // line 62
            echo "                                <td class=\"text-center\">
                                    ";
            // line 63
            echo $this->getAttribute($context["item"], "email", []);
            echo "
                                </td>
                                <td class=\"text-center\">
                                    ";
            // line 66
            echo $this->getAttribute($context["item"], "subject", []);
            echo "
                                </td>
                                <td class=\"text-center\">
                                    ";
            // line 69
            echo $this->getAttribute($context["item"], "send_counter", []);
            echo "
                                </td>
                                ";
            // line 71
            if ((($context["allow_pool_send"] ?? null) || ($context["allow_pool_delete"] ?? null))) {
                // line 72
                echo "                                    <td class=\"icons\">
                                      <div class=\"btn-group\">
                                        ";
                // line 74
                if (($context["allow_pool_send"] ?? null)) {
                    // line 75
                    echo "                                            <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/notifications/pool_send/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                               class=\"btn btn-primary\">";
                    // line 76
                    ob_start(function () { return ''; });
                    // line 77
                    echo "                                                ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_send_pool"                    ,"notifications"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 78
                    echo "                                            ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    echo "</a>
                                        ";
                } elseif (                // line 79
($context["allow_pool_delete"] ?? null)) {
                    // line 80
                    echo "                                            <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/notifications/pool_delete/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                               onclick=\"javascript:
                                                        if(!confirm('";
                    // line 82
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("note_delete_pool"                    ,"notifications"                    ,""                    ,"js"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "'))
                                                        return false;\"
                                               class=\"btn btn-primary\">
                                                    ";
                    // line 85
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_delete_pool"                    ,"notifications"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 86
                    echo "                                            </a>
                                        ";
                }
                // line 88
                echo "                                        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                                aria-haspopup=\"true\" aria-expanded=\"false\">
                                            <span class=\"caret\"></span>
                                            <span class=\"sr-only\">Toggle Dropdown</span>
                                        </button>
                                        <ul class=\"dropdown-menu\">
                                        ";
                // line 94
                if (($context["allow_pool_send"] ?? null)) {
                    // line 95
                    echo "                                          <li>
                                            <a href=\"";
                    // line 96
                    echo ($context["site_url"] ?? null);
                    echo "admin/notifications/pool_send/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                                ";
                    // line 97
                    ob_start(function () { return ''; });
                    // line 98
                    echo "                                                ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_send_pool"                    ,"notifications"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 99
                    echo "                                            ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    echo "</a>
                                          </li>
                                        ";
                }
                // line 102
                echo "                                        ";
                if (($context["allow_pool_delete"] ?? null)) {
                    // line 103
                    echo "                                          <li>
                                            <a href=\"";
                    // line 104
                    echo ($context["site_url"] ?? null);
                    echo "admin/notifications/pool_delete/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                               onclick=\"javascript:
                                                        if(!confirm('";
                    // line 106
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("note_delete_pool"                    ,"notifications"                    ,""                    ,"js"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "'))
                                                        return false;\">
                                                    ";
                    // line 108
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_delete_pool"                    ,"notifications"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 109
                    echo "                                            </a>
                                          </li>
                                        ";
                }
                // line 112
                echo "                                        </ul>
                                      </div>
                                    </td>
                                ";
            }
            // line 116
            echo "                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        echo "                    </tbody>
                </table>
            </div>
        </form>
        ";
        // line 122
        $this->loadTemplate("@app/pagination.twig", "pool.twig", 122)->display($context);
        // line 123
        echo "    </div>
</div>
<!-- Data tables -->
<script type=\"text/javascript\">
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 131
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_all_column"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo ":\",
                \"sEmptyTable\": \"";
        // line 132
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_pool"        ,"notifications"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\"
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': [0,4]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\">lfrtip',
        });
        \$(\"tfoot input\").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
        });
        \$(\"tfoot input\").each(function (i) {
            asInitVals[i] = this.value;
        });
        \$(\"tfoot input\").focus(function () {
            if (this.className == \"search_init\") {
                this.className = \"\";
                this.value = \"\";
            }
        });
        \$(\"tfoot input\").blur(function (i) {
            if (this.value == \"\") {
                this.className = \"search_init\";
                this.value = asInitVals[\$(\"tfoot input\").index(this)];
            }
        });
    });
</script>

<script>
    ";
        // line 168
        if ((($context["allow_pool_send"] ?? null) || ($context["allow_pool_delete"] ?? null))) {
            // line 169
            echo "   /* function checkAll(checked){
        if(checked)
            \$('.grouping:enabled').prop('checked', true);
        else
            \$('.grouping:enabled').prop('checked', false);
    }*/
    function checkBoxes(){
        if(\$('.grouping:checked').length > 0){
            return true;
        }else{
            return false;
        }
    }
    function getCheckBoxes(){
        var ProductID = [];
        \$('[type=checkbox]').each(function() {
            if (this.checked) {
                ProductID[ProductID.length] = \$(this).val();
            }
        });
        return ProductID;
    }
    ";
        }
        // line 192
        echo "    function refresh_pool() {
        \$.ajax({
            url: '";
        // line 194
        echo ($context["ajax_pool_url"] ?? null);
        echo "',
            cache: false,
            success: function(data){
                \$('#pool_data').html(data);
            }
        });
    }
    \$('document').ready(function(){
        \$('#refresh').click(function(){
            refresh_pool();
            return false;
        });
    ";
        // line 206
        if (($context["allow_pool_send"] ?? null)) {
            // line 207
            echo "        \$('#send').click(function(){
            document.location.href = '";
            // line 208
            echo ($context["site_url"] ?? null);
            echo "admin/notifications/pool_send/' + getCheckBoxes();
            return false;
        });
    ";
        }
        // line 212
        echo "    ";
        if (($context["allow_pool_delete"] ?? null)) {
            // line 213
            echo "        \$('#delete').click(function(){

          let chbxs = getCheckBoxes();
          if (chbxs.length > 0) {
            document.location.href = '";
            // line 217
            echo ($context["site_url"] ?? null);
            echo "admin/notifications/pool_delete/' + chbxs;
            return false;
          }

        });
    ";
        }
        // line 223
        echo "    });
</script>

";
        // line 226
        $this->loadTemplate("@app/footer.twig", "pool.twig", 226)->display($context);
    }

    public function getTemplateName()
    {
        return "pool.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  737 => 226,  732 => 223,  723 => 217,  717 => 213,  714 => 212,  707 => 208,  704 => 207,  702 => 206,  687 => 194,  683 => 192,  658 => 169,  656 => 168,  598 => 132,  575 => 131,  565 => 123,  563 => 122,  557 => 118,  550 => 116,  544 => 112,  539 => 109,  518 => 108,  494 => 106,  487 => 104,  484 => 103,  481 => 102,  474 => 99,  452 => 98,  450 => 97,  444 => 96,  441 => 95,  439 => 94,  431 => 88,  427 => 86,  406 => 85,  381 => 82,  373 => 80,  371 => 79,  366 => 78,  344 => 77,  342 => 76,  335 => 75,  333 => 74,  329 => 72,  327 => 71,  322 => 69,  316 => 66,  310 => 63,  307 => 62,  301 => 59,  298 => 58,  296 => 57,  293 => 56,  289 => 55,  284 => 52,  280 => 50,  259 => 49,  256 => 48,  254 => 47,  251 => 46,  230 => 45,  226 => 43,  205 => 42,  201 => 40,  180 => 39,  173 => 38,  169 => 36,  167 => 35,  158 => 29,  152 => 25,  148 => 23,  127 => 22,  124 => 21,  121 => 20,  117 => 18,  96 => 17,  93 => 16,  91 => 15,  88 => 14,  67 => 13,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "pool.twig", "/home/mliadov/public_html/application/modules/notifications/views/gentelella/pool.twig");
    }
}
