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

/* helper_analytics.twig */
class __TwigTemplate_1d903bb345dedef58b4718bca39e984860ecbffbb9355e34b84bd755e04f504a extends \Twig\Template
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
        if ($this->getAttribute($this->getAttribute(($context["analytics"] ?? null), "amplitude", []), "api_key", [])) {
            // line 2
            echo "<script type=\"text/javascript\">
    (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement(\"script\");r.type=\"text/javascript\";
    r.async=true;r.src=\"";
            // line 4
            echo ($context["site_root"] ?? null);
            echo "application/js/amplitude/amplitude.min.js\";
    r.onload=function(){e.amplitude.runQueuedFunctions()};var i=t.getElementsByTagName(\"script\")[0];
    i.parentNode.insertBefore(r,i);function s(e,t){e.prototype[t]=function(){this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));
    return this}}var o=function(){this._q=[];return this};var a=[\"add\",\"append\",\"clearAll\",\"prepend\",\"set\",\"setOnce\",\"unset\"];
    for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[];return this;
    };var p=[\"setProductId\",\"setQuantity\",\"setPrice\",\"setRevenueType\",\"setEventProperties\"];
    for(var l=0;l<p.length;l++){s(c,p[l])}n.Revenue=c;var d=[\"init\",\"logEvent\",\"logRevenue\",\"setUserId\",\"setUserProperties\",\"setOptOut\",\"setVersionName\",\"setDomain\",\"setDeviceId\",\"setGlobalUserProperties\",\"identify\",\"clearUserProperties\",\"setGroup\",\"logRevenueV2\",\"regenerateDeviceId\"];
    function v(e){function t(t){e[t]=function(){e._q.push([t].concat(Array.prototype.slice.call(arguments,0)));
    }}for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){e=(!e||e.length===0?\"\$default_instance\":e).toLowerCase();
    if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]};e.amplitude=n;
    })(window,document);

    amplitude.init('";
            // line 16
            echo $this->getAttribute($this->getAttribute(($context["analytics"] ?? null), "amplitude", []), "api_key", []);
            echo "', '";
            echo ($context["analytics_user_id"] ?? null);
            echo "');
</script>
";
        }
        // line 19
        echo "
";
        // line 20
        if ($this->getAttribute($this->getAttribute(($context["analytics"] ?? null), "mixpanel", []), "api_key", [])) {
            // line 21
            echo "<!-- start Mixpanel -->
<script type=\"text/javascript\">
    (function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+\"=([^&]*)\")))?l[1]:null};g&&c(g,\"state\")&&(i=JSON.parse(decodeURIComponent(c(g,\"state\"))),\"mpeditor\"===i.action&&(b.sessionStorage.setItem(\"_mpcehash\",g),history.replaceState(i.desiredHash||\"\",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(\".\");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
    0)))}}var d=a;\"undefined\"!==typeof f?d=a[f]=[]:f=\"mixpanel\";d.people=d.people||[];d.toString=function(b){var a=\"mixpanel\";\"mixpanel\"!==f&&(a+=\".\"+f);b||(a+=\" (stub)\");return a};d.people.toString=function(){return d.toString(1)+\".people (stub)\"};k=\"disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user\".split(\" \");
    for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement(\"script\");b.type=\"text/javascript\";b.async=!0;b.src=\"undefined\"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:\"file:\"===e.location.protocol&&\"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js\".match(/^\\/\\//)?\"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js\":\"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js\";c=e.getElementsByTagName(\"script\")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
    
    mixpanel.init('";
            // line 27
            echo $this->getAttribute($this->getAttribute(($context["analytics"] ?? null), "mixpanel", []), "api_key", []);
            echo "');
    mixpanel.identify('";
            // line 28
            echo ($context["analytics_user_id"] ?? null);
            echo "');
</script>
<!-- end Mixpanel -->
";
        }
        // line 32
        echo "
<script type=\"text/javascript\">
    var analyticsEvents = {};
    
    function sendAnalyticsF(event, category, type) {
        if (typeof analyticsEvents[category] === 'undefined') {
            return;
        }
        
        for (var i in analyticsEvents[category]) {
            if (analyticsEvents[category][i] != event) {
                continue;
            }
        
            if (typeof amplitude === 'object') {
                amplitude.logEvent(event);
            }
            
            if (typeof mixpanel === 'object') {
                mixpanel.track(event);
            }
    
            if (typeof ga === 'function') {
                ga('send', 'event', category, event, type);
            }
            
            break;
        }
    }
    
    var profiles = ";
        // line 62
        echo ($context["analytics_profiles"] ?? null);
        echo ";
    
    for (var i in profiles) {
        \$.getJSON('";
        // line 65
        echo ($context["site_root"] ?? null);
        echo "analytics/' + profiles[i] + '.json', {}, function(resp) {
            \$.extend(true, analyticsEvents, resp);
        });
    }    
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_analytics.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 65,  115 => 62,  83 => 32,  76 => 28,  72 => 27,  64 => 21,  62 => 20,  59 => 19,  51 => 16,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_analytics.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_analytics.twig");
    }
}
