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

/* user_gallery_magazine.twig */
class __TwigTemplate_b61d50b33eab8e9fc2963a6c6e3315ba615679ccbbbd7460c5a9e9f5983d5372 extends \Twig\Template
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
        // line 2
        echo "<div class=\"content-block\">
    <div class=\"filters-nav mt20 visible-xs-block\">
        <span id=\"filter-nav\"><span class=\"filter-text\">";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gallery_hide_nav"        ,"media"        ,        );
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
        echo "</span> <i class=\"fa fa-angle-up\"></i></span>
    </div>   
    <div class=\"b-album-filters\">
        <div class=\"row\">
            <div class=\"col-xs-12 col-md-8 mb20\">
                <ul class=\"b-tabs\" id=\"filters\">
                    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media_filters"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 11
            echo "                        <li data-param=\"";
            echo $context["key"];
            echo "\" data-user-id=\"";
            echo ($context["id_user"] ?? null);
            echo "\" data-history=\"";
            echo $this->getAttribute($context["item"], "link", []);
            echo "\" class=\"b-tabs__item ";
            if ((($context["gallery_param"] ?? null) == $context["key"])) {
                echo "active";
            }
            echo "\">
                            <span class=\"b-tabs__text\">";
            // line 12
            echo $this->getAttribute($context["item"], "name", []);
            echo "</span>
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "                </ul>
            </div>                    
            <div class=\"col-xs-12 col-md-4 mb20\">
                <div class=\"form-inline\">
                    <div id=\"media_sorter\" class=\"media_sorter b-album-filters__bottom ";
        // line 19
        if ((($context["gallery_param"] ?? null) == "albums")) {
            echo " hide";
        }
        echo "\">
                        <span class=\"media-sorter\">";
        // line 20
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
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["media_sorter"] ?? null), "links", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 23
            echo "                                <option value=\"";
            echo $context["key"];
            echo "\" ";
            if (($context["key"] == $this->getAttribute(($context["media_sorter"] ?? null), "order", []))) {
                echo "selected";
            }
            echo ">
                                    ";
            // line 24
            echo $context["item"];
            echo "
                                </option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "                        </select>
                        <i data-role=\"sorter-dir\" class=\"hidden-xs fa ";
        // line 28
        if (($this->getAttribute(($context["media_sorter"] ?? null), "direction", []) == "ASC")) {
            echo "fa-arrow-up";
        } else {
            echo "fa-arrow-down";
        }
        echo " pointer plr5\"></i>
                    </div>
                </div>
            </div>    
        </div>            
        <div class=\"row\">            
            ";
        // line 34
        if (($context["is_owner"] ?? null)) {
            // line 35
            echo "                <div class=\"col-xs-12 col-md-3 col-lg-2 mb20\">    
                    <div class=\"b-album-filters__addfile\">
                        <div class=\"btn-group\">
                            <button onclick=\"";
            // line 38
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("my_profile"            ,"upload_photo"            ,            );
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
            echo "\" type=\"button\" class=\"btn btn-secondary\" data-media=\"add_photo\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_photo"            ,"media"            ,            );
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
                                <span class=\"sr-only\">Add photo</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                                <li onclick=\"";
            // line 44
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("my_profile"            ,"upload_photo"            ,            );
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
            echo "\"><a data-media=\"add_photo\" href=\"javascript:void(0);\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_photo"            ,"media"            ,            );
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
                                <li onclick=\"";
            // line 45
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("my_profile"            ,"upload_video"            ,            );
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
            echo "\"><a data-media=\"add_video\" href=\"javascript:void(0);\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("add_video"            ,"media"            ,            );
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
            // line 46
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "audio_uploads", [])) {
                // line 47
                echo "                                    <li onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("my_profile"                ,"upload_audio"                ,                );
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
                echo "\"><a data-media=\"add_audio\" href=\"javascript:void(0);\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("add_audio"                ,"audio_uploads"                ,                );
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
            // line 49
            echo "                            </ul>
                        </div>
                    </div>
                </div>
            ";
        }
        // line 54
        echo "            <div class=\"col-xs-12 col-md-9 col-lg-10\">
                <div class=\"form-inline\">
                    <div id=\"album_id_container\" class=\"b-album-filters__bottom ";
        // line 56
        if ((($context["gallery_param"] ?? null) != "albums")) {
            echo " hide";
        }
        echo "\">
                        ";
        // line 57
        echo ($context["albums"] ?? null);
        echo "
                    </div>  
                </div>  
            </div>  
        </div>
    </div>

    <div id=\"gallery_content\" class=\"row g-users-gallery\">
        ";
        // line 66
        echo "            ";
        echo $this->getAttribute(($context["content"] ?? null), "content", []);
        echo "
        ";
        // line 68
        echo "    </div>

    <div class=\"media-button-content ";
        // line 70
        if ( !$this->getAttribute(($context["content"] ?? null), "have_more", [])) {
            echo "hide";
        }
        echo "\">
        <input class=\"btn btn-secondary\" id=\"media_button\" type=\"button\" value=\"";
        // line 71
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("show_more"        ,"media"        ,""        ,"button"        ,        );
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
    </div>
</div>
<script>
    \$(function(){
        loadScripts(
            \"";
        // line 77
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
        echo "\",
            function(){
                mediagallery = new media({
                    siteUrl: site_url,
                    galleryContentPage: ";
        // line 81
        echo ($context["page"] ?? null);
        echo ",
                    btnOk: \"";
        // line 82
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
        // line 83
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
                    galleryContentParam: '";
        // line 84
        echo ($context["gallery_param"] ?? null);
        echo "',
                    idUser: ";
        // line 85
        echo ($context["id_user"] ?? null);
        echo ",
                    all_loaded: ";
        // line 86
        if ($this->getAttribute(($context["content"] ?? null), "have_more", [])) {
            echo "0";
        } else {
            echo "1";
        }
        echo ",
                    lang_delete_confirm: '";
        // line 87
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm"        ,"media"        ,""        ,"js"        ,        );
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
                    lang_delete_confirm_album: '";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm_albums"        ,"media"        ,""        ,"js"        ,        );
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
        echo "'
                });
            },
            ['mediagallery'],
            {async: true}
        );
        \$('#filter-nav').click(function () {
            \$('.b-album-filters').toggle();
            if (\$('.b-album-filters').is(':visible')) {  
                localStorage.setItem('filter-nav', 'open');              
                \$('#filter-nav i').removeClass(\"fa-angle-down\");
                \$('#filter-nav i').addClass(\"fa-angle-up\");
                \$('#filter-nav .filter-text').html(\"";
        // line 100
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gallery_hide_nav"        ,"media"        ,        );
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
        echo "\");
            } else {  
                localStorage.setItem('filter-nav', 'close');         
                \$('#filter-nav i').removeClass(\"fa-angle-up\");
                \$('#filter-nav i').addClass(\"fa-angle-down\");
                \$('#filter-nav .filter-text').html(\"";
        // line 105
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gallery_show_nav"        ,"media"        ,        );
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
        echo "\");
            }    
        });

        if (localStorage.getItem('filter-nav') == 'close') {
            \$('.b-album-filters').toggle();
            \$('#filter-nav i').removeClass(\"fa-angle-up\");
            \$('#filter-nav i').addClass(\"fa-angle-down\");
            \$('#filter-nav .filter-text').html(\"";
        // line 113
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gallery_show_nav"        ,"media"        ,        );
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
        echo "\");
            localStorage.setItem('filter-nav', 'close'); 
        } 

        // \$(window).on('resize', function(){
        //     \$('.b-album-filters').show();                
        //     \$('#filter-nav i').removeClass(\"fa-angle-down\");
        //     \$('#filter-nav i').addClass(\"fa-angle-up\");
        //     \$('#filter-nav .filter-text').html(\"";
        // line 121
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gallery_hide_nav"        ,"media"        ,        );
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
        echo "\");
        // });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "user_gallery_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  682 => 121,  652 => 113,  622 => 105,  595 => 100,  561 => 88,  538 => 87,  530 => 86,  526 => 85,  522 => 84,  499 => 83,  476 => 82,  472 => 81,  446 => 77,  418 => 71,  412 => 70,  408 => 68,  403 => 66,  392 => 57,  386 => 56,  382 => 54,  375 => 49,  329 => 47,  327 => 46,  283 => 45,  239 => 44,  190 => 38,  185 => 35,  183 => 34,  170 => 28,  167 => 27,  158 => 24,  149 => 23,  145 => 22,  121 => 20,  115 => 19,  109 => 15,  100 => 12,  87 => 11,  83 => 10,  55 => 4,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_gallery_magazine.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/user_gallery_magazine.twig");
    }
}
