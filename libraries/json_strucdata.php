<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "<?=$company['ten']?>",
  "url": "<?=$http.$config_url?>",
  "sameAs": ["<?=$company['facebook']?>","<?=$company['tiwtter']?>","<?=$company['google']?>","<?=$company['youtube']?>","<?=$company['instagram']?>","<?=$company['skype']?>" ],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?=$company['diachi']?>",
    "addressRegion": "<?=$company['thanhpho']?>",
    "postalCode": "<?=$company['mabuuchinh']?>",
    "addressCountry": "vi"
  }
}
</script>
<?php if($template=='product_detail' ) {?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?=$row_detail['ten']?>",
  "image": [
    <?php $count=count($hinhthem); if($count>0) {?>
      <?php foreach($hinhthem as $k=>$v){?>
        "<?=$http.$config_url?>/<?=_upload_hinhthem_l.$v['photo']?>",
      <?php }?>
    <?php }?>
    "<?=$http.$config_url?>/<?=_upload_sanpham_l.$row_detail['photo']?>"
  ],
  "description": "<?=$description?>",
  "sku": "<?=$row_detail['id']?>",
  "mpn": "925872",
  "brand": {
    "@type": "Thing",
    "name": "<?=$link_danhmuc['ten']?>"
  },
  "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "<?=$row_detail['rate'] > 0 ? $row_detail['rate'] : 4?>",
      "bestRating": "5"
    },
    "author": {
      "@type": "Person",
      "name": "<?=$company['ten']?>"
    }
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.4",
    "reviewCount": "89"
  },
  "offers": {
    "@type": "Offer",
    "url": "<?=getCurrentPageURL_CANO()?>",
    "priceCurrency": "VND",
    "price": "<?=$row_detail['gia']?>",
    "priceValidUntil": "2020-11-05",
    "itemCondition": "https://schema.org/UsedCondition",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Executive Objects"
    }
  }
}
</script>
<?php } ?>
<?php if($template=='news_detail' ){?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://google.com/article"
  },
  "headline": "<?=$row_detail['ten']?>",
  "image": ["<?=$http.$config_url?>/<?=_upload_product_l.$row_detail['photo']?>"],
  "datePublished": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
  "dateModified": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
  "author": {
    "@type": "Person",
    "name": "<?=$company['ten']?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Google",
    "logo": {
      "@type": "ImageObject",
      "url": "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$seo['thumb']?>"
    }
  },
  "description": "<?=$description?>"
}
</script>
<?php }?>
<?php if($template=='about' ){?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://google.com/article"
  },
  "headline": "<?=$row_detail['ten']?>",
  "image": ["<?=$http.$config_url?>/<?=_upload_hinhanh_l.$row_detail['photo']?>"],
  "datePublished": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
  "dateModified": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
  "author": {
    "@type": "Person",
    "name": "<?=$company['ten']?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Google",
    "logo": {
      "@type": "ImageObject",
      "url": "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$seo['thumb']?>"
    }
  },
  "description": "<?=$description?>"
}
</script>
<?php }?>