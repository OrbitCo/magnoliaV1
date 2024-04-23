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

/* moder_block.twig */
class __TwigTemplate_59a54f784356a2710def62b5f89d6c11ef28d9cc8ab77fa379f6f467f88594f0 extends \Twig\Template
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
        ob_start(function () { return ''; });
        // line 2
        echo "    ";
        $context["rand"] = twig_random($this->env, 111111, 999999);
        // line 3
        echo "    <div class=\"form-group\">
        ";
        // line 4
        if (($this->getAttribute(($context["data"] ?? null), "upload_gid", []) == "gallery_audio")) {
            // line 5
            echo "            <audio src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "mediafile", []), "file_url", []);
            echo "\" controls style=\"max-width: 100%;\"></audio>
        ";
        } elseif ($this->getAttribute(        // line 6
($context["data"] ?? null), "media", [])) {
            // line 7
            echo "            <a href=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "mediafile", []), "file_url", []);
            echo "?";
            echo ($context["rand"] ?? null);
            echo "\" target=\"_blank\">
                ";
            // line 8
            $module =             null;
            $helper =             'media';
            $name =             'load_picture';
            $params = array(["thumbs" => $this->getAttribute($this->getAttribute($this->getAttribute(            // line 9
($context["data"] ?? null), "media", []), "mediafile", []), "thumbs", []), "size" => "big", "class" => "img-responsive pointer"]            ,            );
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
            // line 13
            echo "            </a>
        ";
        } elseif ($this->getAttribute(        // line 14
($context["data"] ?? null), "video_content", [])) {
            // line 15
            echo "            <span id=\"video";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "\">
                ";
            // line 16
            $module =             null;
            $helper =             'media';
            $name =             'load_picture';
            $params = array(["thumbs" => $this->getAttribute($this->getAttribute(            // line 17
($context["data"] ?? null), "video_content", []), "thumbs", []), "size" => "big", "class" => "img-responsive pointer"]            ,            );
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
            // line 21
            echo "            </span>
            <div id=\"video";
            // line 22
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "-content\" class=\"hide\">
                ";
            // line 23
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "video_content", []), "embed", []);
            echo "
            </div>
            <script>
                            \$(function () {
                                \$('#video";
            // line 27
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "').on('click', function (e) {
                                    e.preventDefault();
                                    var vpreview = new loadingContent({'closeBtnClass': 'w'});
                                    vpreview.show_load_block(\$('#video";
            // line 30
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "-content').html());
                                })
                            });
            </script>
        ";
        }
        // line 35
        echo "        <br>
        <label>";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"media"        ,        );
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
        echo ":</label> ";
        echo $this->getAttribute(($context["data"] ?? null), "fname", []);
        echo "<br>
        <label>";
        // line 37
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("media_owner"        ,"media"        ,        );
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
        echo ":</label>&nbsp;
        <a href=\"";
        // line 38
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/";
        echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "owner_info", []), "id", []);
        echo "\" target=\"_blank\" >";
        echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "owner_info", []), "output_name", []);
        echo "</a><br>
    </div>
    <div class=\"form-group ";
        // line 40
        if ((($context["template"] ?? null) == "dashboard")) {
            echo "hide";
        }
        echo "\">
        <b>";
        // line 41
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_permitted_for"        ,"media"        ,        );
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
        echo "</b>:
        ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'ld_option';
        $params = array("permissions"        ,"media"        ,$this->getAttribute(($context["data"] ?? null), "permissions", [])        ,        );
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
        echo "    </div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "moder_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 43,  225 => 42,  202 => 41,  196 => 40,  187 => 38,  164 => 37,  139 => 36,  136 => 35,  128 => 30,  122 => 27,  115 => 23,  111 => 22,  108 => 21,  90 => 17,  86 => 16,  81 => 15,  79 => 14,  76 => 13,  58 => 9,  54 => 8,  47 => 7,  45 => 6,  40 => 5,  38 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "moder_block.twig", "/home/mliadov/public_html/application/modules/media/views/gentelella/moder_block.twig");
    }
}
