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

/* user_media_block_magazine.twig */
class __TwigTemplate_0ecd29bbc155de3f85c46f1167dd89bce920e169bb574e52d2290ba434d1851f extends \Twig\Template
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
        $context["thumb_name"] = $this->getAttribute(($context["recent_thumb"] ?? null), "name", []);
        // line 2
        echo "<div class=\"mag-recent-media\">
    ";
        // line 3
        if (($this->getAttribute(($context["user_session_data"] ?? null), "user_id", []) == ($context["id_user"] ?? null))) {
            // line 4
            echo "        <div class=\"mag-recent-media__item mag-recent-media__item_upload\" onclick=\"";
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
            echo "\">
            <a href=\"javascript:void(0);\" data-media=\"add_photo\">";
            // line 5
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
            echo "</a>
        </div>
    ";
        }
        // line 8
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["recent_photos_data"] ?? null), "media", []));
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
            // line 9
            echo "        <div class=\"mag-recent-media__item ";
            if (($this->getAttribute($context["loop"], "index", []) == 3)) {
                echo "mag-recent-media__item_hidden";
            }
            echo "\" data-click=\"view-media\" data-user-id=\"";
            echo $this->getAttribute($context["item"], "id_owner", []);
            echo "\" data-id-media=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"   ";
            // line 10
            echo "              data-is-private=\"";
            if (($this->getAttribute($context["item"], "permissions", []) == 5)) {
                echo "1";
            } else {
                echo "0";
            }
            echo "\"
              style=\"position: relative;\">
            ";
            // line 12
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_video")) {
                // line 13
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_video"                ,"media"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_media_video'] = $result;
                // line 14
                echo "                ";
                $module =                 null;
                $helper =                 'media';
                $name =                 'load_picture';
                $params = array(["thumbs" => $this->getAttribute($this->getAttribute(                // line 15
($context["item"] ?? null), "video_content", []), "thumbs", []), "size" => "middle", "alt" =>                 // line 17
($context["text_media_video"] ?? null), "class" => "middle img-responsive"]                ,                );
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
                echo "            ";
            } else {
                // line 23
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_photo"                ,"media"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_media_photo'] = $result;
                // line 24
                echo "                ";
                $module =                 null;
                $helper =                 'media';
                $name =                 'load_picture';
                $params = array(["thumbs" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 25
($context["item"] ?? null), "media", []), "mediafile", []), "thumbs", []), "size" => "middle", "alt" =>                 // line 27
($context["text_media_photo"] ?? null), "class" => "middle img-responsive"]                ,                );
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
                // line 30
                echo "
";
                // line 33
                echo "            ";
            }
            // line 34
            echo "        </div>
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
        // line 35
        echo " 
    ";
        // line 36
        if (($context["gallery_link"] ?? null)) {
            // line 37
            echo "        <div class=\"mag-recent-media__item\"><a href=\"";
            echo ($context["gallery_link"] ?? null);
            echo "/all\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("view_gallery"            ,"media"            ,            );
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
            echo "</a></div>
    ";
        }
        // line 39
        echo "</div>

<script>
    \$(function(){
        loadScripts(
            \"";
        // line 44
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
                    galleryContentPage: '1',
                    btnOk: \"";
        // line 49
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
        // line 50
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
                    galleryContentParam: 'all',
                    idUser: ";
        // line 52
        echo ($context["id_user"] ?? null);
        echo ",
                    all_loaded: ";
        // line 53
        if ($this->getAttribute(($context["content"] ?? null), "have_more", [])) {
            echo "0";
        } else {
            echo "1";
        }
        echo ",
                    lang_delete_confirm: '";
        // line 54
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
        // line 55
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
        echo "',
                    recentTemplate: 'magazine',
                    mSendDisabled: \"";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_send_disabled"        ,"users"        ,""        ,"js"        ,        );
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
                    mRequestExists: \"";
        // line 58
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_request_exists"        ,"users"        ,""        ,"js"        ,        );
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
                    mViewDisabled: \"";
        // line 59
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_view_disabled"        ,"users"        ,""        ,"js"        ,        );
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
                });
            },
            ['mediagallery'],
            {async: true}
        );
    });
</script>";
    }

    public function getTemplateName()
    {
        return "user_media_block_magazine.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  460 => 59,  437 => 58,  414 => 57,  390 => 55,  367 => 54,  359 => 53,  355 => 52,  331 => 50,  308 => 49,  281 => 44,  274 => 39,  247 => 37,  245 => 36,  242 => 35,  227 => 34,  224 => 33,  221 => 30,  203 => 27,  202 => 25,  197 => 24,  175 => 23,  172 => 22,  154 => 17,  153 => 15,  148 => 14,  126 => 13,  124 => 12,  114 => 10,  104 => 9,  86 => 8,  61 => 5,  37 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_media_block_magazine.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/user_media_block_magazine.twig");
    }
}
