$(document).ready(() => {
    $("body").find("#allTitles").mouseenter(() => {
        $("body").find("#link").stop().slideToggle("slow");
        pop = true
    }).mouseleave(() => {
        $("body").find("#link").stop().slideToggle("slow");
    })

    let iframeVideo = $("body").find("iframe")
    let url = iframeVideo.attr('src');
    $(".modal").on('hide.bs.modal', function(){
        iframeVideo.attr('src', '');
        setTimeout(() => {
            reloadSrcVideo(iframeVideo, url);
        }, 100);
    });

     const reloadSrcVideo = (iframeVideo, url) => {
        $(".modal").on('show.bs.modal', () => {
            iframeVideo.attr('src', url);
        });
    } 
})

