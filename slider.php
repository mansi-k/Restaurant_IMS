<div id="Carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <div class="item active" id="vid">
            <div id="vidf" class="img-responsive">
                <video id="cvideo" autoplay="autoplay" onended="carslide()" onplay="carpause()">
                    <source src="videos/Willsionkitchen.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="item" id="vnext">
            <img src="images/slider/slide1.jpg" class="img-responsive">
        </div>
        <div class="item">
            <img src="images/slider/slide2.jpg" class="img-responsive">
        </div>
        <div class="item">
            <img src="images/slider/slide3.jpg" class="img-responsive">
        </div>
        <div class="item">
            <img src="images/slider/slide4.jpg" class="img-responsive">
        </div>
    </div>
    <a class="left carousel-control" href="#Carousel" data-slide="prev" onclick="vslide()">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#Carousel" data-slide="next" onclick="vslide()">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<script>
    $('#Carousel').carousel({
        interval: false
    });

    var flag;
    var cp=1;
    var c = $('#Carousel');
    function carslide()
    {
        if($('#cvideo')[0].paused) {
            opt = c.data()['bs.carousel'].options;
            opt.interval = 2000;
            c.data({options: opt});
            c.carousel('next');
            c.carousel('cycle');
            flag = 0;
        }
    }

    function carpause()
    {
        c.carousel(0);
        opt = c.data()['bs.carousel'].options;
        opt.interval= false;
        c.data({options: opt});
        flag=1;
    }


    $('#Carousel').on('slid.bs.carousel', function(e) {
        var index = $(e.target).find(".active").index();
        if(index === 1)
        {
            if($('#cvideo')[0].ended)
            {
                var ht = $('#Carousel .img-responsive').height();
                $('#vidf').height(ht);
                $('#cvideo').prop('autoplay', false);
                $('#cvideo').attr('src', 'videos/Willsionkitchen.mp4');
                $('#cvideo')[0].load();
            }
            flag=0;
        }
        else if(index === 0)
        {

        }
    });

    $(window).scroll(function() {
        if ($('#vid').hasClass('active')) {
            var offset = $('#vidf').offset();
            var tscroll = offset.top + $('#vidf').height();
            if ($(document).scrollTop() > tscroll && !$('#cvideo').ended && cp) {
                $('#cvideo')[0].pause();
            }
            else if ($('#cvideo')[0].paused && flag && cp) {
                $('#cvideo')[0].play();
            }
        }
    });

    $('#cvideo').click(function(){
        if(this.paused)
        {
            this.play();
            cp=1;
        }
        else if(this.play)
        {
            this.pause();
            cp=0;
        }
    });

    function vslide()
    {
        if($('#cvideo')[0].play)
        {
            $('#cvideo')[0].pause();
            carslide();
        }
    }

</script>