<script type="text/javascript">
function gdlbImageSelection(index, imgId) {
    var gdlbAllImages = [ <?php echo $gdlb_js_items; ?> ];
    var gdlbImage = document.getElementById(imgId);

    gdlbImage.src = "http://www.linkedin.com/img/webpromo/" + gdlbAllImages[index];
}
</script>
<style>
    .gdlb-fieldset { border: 1px #DDDDDD solid; padding: 6px; margin: 6px 0; }
    .gdlb-input { margin: 5px 0; width: 100%; }
</style>
