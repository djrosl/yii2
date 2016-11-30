(function($){
    
    $('#filterForm input,#filterForm select').change(function(){
       processFilter(this);
    });

    $('.light-gallery-dynamic').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var that = this;
        $.get(href, function(response){
            $(that).lightGallery({
                dynamic: true,
                dynamicEl: response,
                thumbnail: false
            });
        });

    });

    $('.prepare-ajax').submit(function(e){
        e.preventDefault();
        var data = {
            'str':JSON.stringify(prepareFields($(this)))
        };
        var formUrl = $(this).attr('action');
        $.post(formUrl, data, function(success){
            //console.log(success);
            if(success) {
                closeModal();
                openModal('success');
                setTimeout(function(){
                    closeModal();
                }, 1500);
            }
            $('input:not([type="hidden"]), textarea').val('')
        });
    });

    $('.modal-opener').click(function(e){
        e.preventDefault();

        var id = $(this).data('modal');
        openModal(id);
        addHiddenFields(id, $(this).data('hidden-fields'));
    });

    $('.modal-close').click(function(e){
        e.preventDefault();

        var id = $(this).parent().attr('id');
        closeModal(id);
    });

    $(window).load(function(){
        setTimeout(function(){
            if(openEmailPopup) {
                openModal('addProfile');
            }
        }, 500);
    });

    function processFilter(elem, outElem){
        outElem = outElem || '#filterOuter';
        var action = $(elem).parents('form').attr('action');
        var data = $(elem).parents('form').serialize();
        $.post(action, data, function(response){
            $(outElem).html(response);
        });
    }
    function openModal(id){
        $('#'+id).addClass('modal-active').fadeIn(600)
    }
    function addHiddenFields(modalId, fields) {
        var elem = "#"+modalId;
        fields.forEach(function(item){
            var html = '<input type="hidden" name="'+item.name+'" value="'+item.value+'" data-label="'+item.label+'">';
            $(elem).next().find('form').append(html)
        });
    }
    function closeModal(id){
        id = id | false
        if(!id){
            return $('.modal-active').removeClass('modal-active').fadeOut(300);
        }
        $('#'+id).removeClass('modal-active').fadeOut(300);
    }
    function prepareFields(form) {
        var data = [];
        form.find('label').each(function(){
           data.push({
               'label':$(this).text(),
               'name':$(this).next().attr('name'),
               'value':$(this).next().val()
           });
        });

        $(form).find('input[type="hidden"]').each(function(){
            data.push({
                'label':$(this).data('label'),
                'name':$(this).attr('name'),
                'value':$(this).val()
            });
        });

        return data;
    }
})($);

