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

/* tree_level.twig */
class __TwigTemplate_9f2ac0d9d65fe3bd3f4dbe1822d043ac3d294e130c6db8c23ea2608f2eb0abfd extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    ";
            $context["id"] = $this->getAttribute($context["item"], "id", []);
            // line 3
            echo "<li id=\"item_";
            echo ($context["id"] ?? null);
            echo "\" class=\"x_panel\">
    <div id=\"clsr";
            // line 4
            echo ($context["id"] ?? null);
            echo "\"></div>
    <div class=\"editable js-item\">
      ";
            // line 6
            if ($this->getAttribute($context["item"], "sub", [])) {
                echo "<a class=\"collapse-link\"><i class=\"fa fa-chevron-down\"></i></a>";
            }
            // line 7
            echo "      ";
            echo $this->getAttribute($context["item"], "value", []);
            echo " (<span><span data-action=\"1\" class=\"js-toggle-title ";
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo " hide";
            }
            echo "\"
         title=\"";
            // line 8
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            echo "\">
          ";
            // line 9
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_active"            ,"start"            ,            );
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
            // line 10
            echo "      </span><span data-action=\"0\" class=\"js-toggle-title ";
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo " hide";
            }
            echo "\">
          ";
            // line 11
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_tableicon_is_not_active"            ,"start"            ,            );
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
            // line 12
            echo "      </span></span>)
      <div class=\"nav navbar-right panel_toolbox\">
          <div class=\"btn-group\">
              <span class=\"btn btn-primary\">
                <a href=\"javascript:;\" class=\"js-activate ";
            // line 16
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo "hide";
            }
            echo "\"
                   data-id=\"";
            // line 17
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data-action=\"0\">
                    ";
            // line 18
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            // line 19
            echo "                </a><a href=\"javascript:;\" class=\"js-activate ";
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo "hide";
            }
            echo "\"
                       data-id=\"";
            // line 20
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data-action=\"1\">
                    ";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_active"            ,"start"            ,            );
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
            // line 22
            echo "                </a>
              </span>
              <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                      aria-haspopup=\"true\" aria-expanded=\"false\">
                  <span class=\"caret\"></span>
                  <span class=\"sr-only\">Toggle Dropdown</span>
              </button>
              <ul class=\"dropdown-menu\">
                  <li>
                    <a href=\"javascript:;\" class=\"js-activate ";
            // line 31
            if (($this->getAttribute($context["item"], "status", []) != 1)) {
                echo "hide";
            }
            echo "\"
                       data-id=\"";
            // line 32
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data-action=\"0\">
                        ";
            // line 33
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_inactive"            ,"start"            ,            );
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
            // line 34
            echo "                    </a><a href=\"javascript:;\" class=\"js-activate ";
            if (($this->getAttribute($context["item"], "status", []) == 1)) {
                echo "hide";
            }
            echo "\"
                           data-id=\"";
            // line 35
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data-action=\"1\">
                        ";
            // line 36
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("make_active"            ,"start"            ,            );
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
            // line 37
            echo "                    </a>
                  </li>
                  ";
            // line 39
            if (($this->getAttribute($context["item"], "parent_id", []) == 0)) {
                // line 40
                echo "                  <li>
                    <a href=\"";
                // line 41
                echo ($context["site_url"] ?? null);
                echo "admin/menu/items_edit/";
                echo $this->getAttribute($context["item"], "menu_id", []);
                echo "/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                        ";
                // line 42
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("button_create_submenu"                ,"menu"                ,                );
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
                echo "                    </a>
                  </li>
                  ";
            }
            // line 46
            echo "                  <li>
                      <a href=\"";
            // line 47
            echo ($context["site_url"] ?? null);
            echo "admin/menu/items_edit/";
            echo $this->getAttribute($context["item"], "menu_id", []);
            echo "/";
            echo $this->getAttribute($context["item"], "parent_id", []);
            echo "/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                          ";
            // line 48
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_tableicon_edit"            ,"menu"            ,            );
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
            // line 49
            echo "                      </a>
                  </li>
                  <li>
                      ";
            // line 56
            echo "                      <a href=\"#\" onclick=\"mlSorter.deleteItem(";
            echo $this->getAttribute($context["item"], "id", []);
            echo "); return false;\">
                          ";
            // line 57
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_tableicon_delete"            ,"menu"            ,            );
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
            // line 58
            echo "                      </a>
                  </li>
              </ul>
          </div>
        </div>
    </div>
    ";
            // line 64
            if ($this->getAttribute($context["item"], "sub", [])) {
                // line 65
                echo "        <script type=\"text/javascript\">
            \$(function () {
                mlSorter.properties.subItemIds.push('#clsr";
                // line 67
                echo ($context["id"] ?? null);
                echo "ul');
            });
        </script>
    ";
            }
            // line 71
            echo "    <ul id=\"clsr";
            echo ($context["id"] ?? null);
            echo "ul\" class=\"x_content sort connected\" name=\"parent_";
            echo ($context["id"] ?? null);
            echo "\" style=\"display: none;\">
        ";
            // line 72
            $this->loadTemplate("tree_level.twig", "tree_level.twig", 72)->display(twig_array_merge($context, ["list" => $this->getAttribute($context["item"], "sub", []), "main" => false]));
            // line 73
            echo "    </ul>
</li>
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "tree_level.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  426 => 73,  424 => 72,  417 => 71,  410 => 67,  406 => 65,  404 => 64,  396 => 58,  375 => 57,  370 => 56,  365 => 49,  344 => 48,  334 => 47,  331 => 46,  326 => 43,  305 => 42,  297 => 41,  294 => 40,  292 => 39,  288 => 37,  267 => 36,  263 => 35,  256 => 34,  235 => 33,  231 => 32,  225 => 31,  214 => 22,  193 => 21,  189 => 20,  182 => 19,  161 => 18,  157 => 17,  151 => 16,  145 => 12,  124 => 11,  117 => 10,  96 => 9,  73 => 8,  64 => 7,  60 => 6,  55 => 4,  50 => 3,  47 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "tree_level.twig", "/home/mliadov/public_html/application/modules/menu/views/gentelella/tree_level.twig");
    }
}
