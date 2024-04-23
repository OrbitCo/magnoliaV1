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

/* gallery.twig */
class __TwigTemplate_dc5e8e0a3aab6fb289bf1032393572fcb2fa245bfbbf31460b285da3fdbf9a61 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "gallery.twig", 1)->display($context);
        // line 2
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("audio_uploads"        ,        );
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
        $context['is_module_installed'] = $result;
        // line 3
        echo "<div class=\"col-xs-12 content-block\">
    <h1>
        ";
        // line 5
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
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
        // line 6
        echo "    </h1>
    <div class=\"g-flatty-block\">
        <div class=\"row g-flatty-block__header\">
            <div class=\"col-sm-6 col-md-9\">
                <ul class=\"b-tabs\" id=\"gallery_filters\">
                    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media_filters"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 12
            echo "                        <li data-param=\"";
            echo $context["key"];
            echo "\" class=\"b-tabs__item ";
            if ((($context["gallery_param"] ?? null) == $context["key"])) {
                echo "active";
            }
            echo "\">
                            <a href=\"";
            // line 13
            echo $this->getAttribute($context["item"], "link", []);
            echo "\" class=\"b-tabs__text\">
                                <span>";
            // line 14
            echo $this->getAttribute($context["item"], "name", []);
            echo "</span>
                            </a>
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "                </ul>
            </div>
            <div class=\"col-sm-6 col-md-3 b-album-filters__addfile\">
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-media=\"add_photo\">";
        // line 22
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_photo"        ,"media"        ,        );
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
        echo "</button>
                    <button type=\"button\" class=\"btn btn-secondary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">";
        // line 25
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_photo"        ,"media"        ,        );
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
        echo "</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li><a data-media=\"add_photo\" href=\"javascript:void(0);\">";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_photo"        ,"media"        ,        );
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
        echo "</a></li>
                        <li><a data-media=\"add_video\" href=\"javascript:void(0);\">";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_video"        ,"media"        ,        );
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
        echo "</a></li>
                            ";
        // line 30
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "audio_uploads", [])) {
            // line 31
            echo "                            <li><a data-media=\"add_audio\" href=\"javascript:void(0);\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_audio"            ,"audio_uploads"            ,            );
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
            echo "</a></li>
                            ";
        }
        // line 33
        echo "                    </ul>
                </div>
            </div>
        </div>
        <div class=\"g-flatty-block__control form-inline\">
            <div class=\"col-xs-12\">
                <span id=\"gallery_albums\" class=\"form-group ";
        // line 39
        if ((($context["gallery_param"] ?? null) != "albums")) {
            echo "hide";
        }
        echo "\">
                    ";
        // line 40
        echo ($context["albums"] ?? null);
        echo "
                </span>&nbsp;&nbsp;
                <span id=\"gallery_media_sorter\" class=\"form-group ";
        // line 42
        if ((($context["gallery_param"] ?? null) == "albums")) {
            echo "hide";
        }
        echo "\">
                    <span class=\"media-sorter\">";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("sort_by"        ,"start"        ,        );
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
        echo "&nbsp;</span>
                    <select class=\"form-control\">
                        ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["media_sorter"] ?? null), "links", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 46
            echo "                            <option value=\"";
            echo $context["key"];
            echo "\" ";
            if (($context["key"] == $this->getAttribute(($context["media_sorter"] ?? null), "order", []))) {
                echo "selected";
            }
            echo ">
                                ";
            // line 47
            echo $context["item"];
            echo "
                            </option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "                    </select>
                    <i data-role=\"sorter-dir\" class=\"hidden-xs fa ";
        // line 51
        if (($this->getAttribute(($context["media_sorter"] ?? null), "direction", []) == "ASC")) {
            echo "fa-arrow-up";
        } else {
            echo "fa-arrow-down";
        }
        echo " pointer plr5\"></i>
                </span>  
            </div>
            <div class=\"clearfix\"></div>
        </div>

        <div id=\"gallery\" class=\"row g-users-gallery\"></div>
    </div>
</div>
<div class=\"clr\"></div>
<script>
    \$(function () {
        loadScripts(
                [
                    \"";
        // line 65
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"../views/flatty/js/gallery.js"        ,"path"        ,        );
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
        echo "\",
                    \"";
        // line 66
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"../views/flatty/js/media.js"        ,"path"        ,        );
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
                ],
                function () {
                    sitegallery = new gallery({
                        id: 'gallery',
                        site_url: site_url,
                        get_list_url: 'media/ajax_get_gallery_render_list/',
                        button_title: '";
        // line 73
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("show_more"        ,"media"        ,        );
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
        echo "',
                        load_on_scroll: false,
                        id_category: 0,
                        columns_per_line: 10,
                        column_width: 100,
                        margins: 5,
                    });
                    mediagallery = new media({
                        siteUrl: site_url,
                        galleryContentPage: 1,
                        btnOk: \"";
        // line 83
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_ok"        ,"start"        ,        );
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
        echo "\",
                        btnCancel: \"";
        // line 84
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
        echo "\",
                        idUser: 0,
                        all_loaded: 1,
                        lang_delete_confirm: \"";
        // line 87
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm"        ,"media"        ,        );
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
        echo "\",
                        lang_delete_confirm_album: \"";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm_albums"        ,"media"        ,        );
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
        echo "\",
                        galleryContentDiv: 'gallery',
                        post_data: {filter_duplicate: 1},
                        load_on_scroll: false,
                        sorterId: 'gallery_media_sorter',
                        is_guest: '";
        // line 93
        echo ($context["is_guest"] ?? null);
        echo "'
                    });
                    sitegallery.init().load();
                },
                ['sitegallery', 'mediagallery'],
                {async: false}
        );
    });
</script>

";
        // line 103
        $this->loadTemplate("@app/footer.twig", "gallery.twig", 103)->display($context);
    }

    public function getTemplateName()
    {
        return "gallery.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  531 => 103,  518 => 93,  491 => 88,  468 => 87,  443 => 84,  420 => 83,  388 => 73,  359 => 66,  336 => 65,  315 => 51,  312 => 50,  303 => 47,  294 => 46,  290 => 45,  266 => 43,  260 => 42,  255 => 40,  249 => 39,  241 => 33,  216 => 31,  214 => 30,  191 => 29,  168 => 28,  143 => 25,  118 => 22,  112 => 18,  102 => 14,  98 => 13,  89 => 12,  85 => 11,  78 => 6,  57 => 5,  53 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "gallery.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/gallery.twig");
    }
}
