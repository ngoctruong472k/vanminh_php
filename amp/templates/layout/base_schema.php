<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "http://<?=$config_url?>",
  "logo": "http://<?=$config_url?>/images/logo.png",
  "contactPoint" : [{
    "@type" : "ContactPoint",
    "telephone" : "+84 <?=$setting->getSetting('hotline')?>",
    "contactType" : "Customer service"
  }],
  "sameAs" : [
    "<?=$setting->getSetting('facebook')?>"<?php if($setting->getSetting('google')!=''){?>,
    "<?=$setting->getSetting('google')?>"<?php }?><?php if($setting->getSetting('twitter')!=''){?>,
    "<?=$setting->getSetting('twitter')?>"<?php }?><?php if($setting->getSetting('youtube')!=''){?>,
    "<?=$setting->getSetting('youtube')?>"<?php }?>
  ],
  "potentialAction": {
    "@type": "SearchAction",
    "target": "http://<?=$config_url?>/tim-kiem/keyword={q}",
    "query-input": "required name=q"
  }
}
</script>
<?php if($template=='post_detail'){?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?=getCurrentPageURL()?>"
  },
  "headline": "<?php if($title_bar!=''){?><?=bokytuSEO($title_bar)?><?php }else{?><?=$setting->getSetting('title')?><?php }?>",
  "image": {
    "@type": "ImageObject",
    "url": "<?php if(isset($og_img) && $og_img!=''){?><?=$og_img?><?php }else{?>http://<?=$config_url?>/images/logo.png<?php }?>",
    "height": 800,
    "width": 800
  },
  "datePublished": "<?=date('Y-m-d\TH:i:sP',$row_postDetail['ngaytao'])?>",
  "dateModified": "<?=date('Y-m-d\TH:i:sP',$row_postDetail['ngaytao'])?>",
  "author": {
    "@type": "Person",
    "name": "Hoa Lợi"
  },
   "publisher": {
    "@type": "Organization",
    "name": "<?=$setting->getSetting('ten')?>",
    "logo": {
      "@type": "ImageObject",
      "url": "http://<?=$config_url?>/images/logo.png"
    }
  },
  "description": "<?php if($description!=''){?><?=bokytuSEO($description)?><?php }else{?><?=$setting->getSetting('description')?><?php }?>"
}
</script>
<?php }?>
<?php if($template=='product_detail'){?>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "<?php if($title_bar!=''){?><?=bokytuSEO($title_bar)?><?php }else{?><?=$setting->getSetting('title')?><?php }?>",
  "image": "<?php if(isset($og_img) && $og_img!=''){?><?=$og_img?><?php }else{?>http://<?=$config_url?>/images/logo.png<?php }?>",
  "description": "<?php if($description!=''){?><?=bokytuSEO($description)?><?php }else{?><?=$setting->getSetting('description')?><?php }?>",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VNĐ",
    "price": "<?php if($row_productDetail['giagiam']!=0 && $row_productDetail['gia']!=0 ){?><?=number_format($row_productDetail['giagiam'],0,",",".")?><?php }else{?><?=number_format($row_productDetail['gia'],0,",",".")?><?php }?>",
    "itemCondition": "http://schema.org/UsedCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "<?=$setting->getSetting('ten')?>"
    }
  }
}
</script>
<?php }?>