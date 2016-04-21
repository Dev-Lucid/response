if (typeof lucid === 'undefined') {
    var lucid = {};
}

if (typeof(lucid.messages) !== 'function') {
    lucid.messages.show=function(status, messageList){
        var text = status + '\n------------------------------\n';
        text += messageList.join('\n');
        alert(text);
    };
}

lucid.jsonResponse=function(xhr, statusCode){
    //lucid.callHandlers('pre-handleResponse', {'jqxhr':xhr, 'statusCode':statusCode});
    if (statusCode == 'success'){
        console.log(xhr.responseJSON);
        var status = xhr.responseJSON.status;
        var data = xhr.responseJSON.data;

        if (data.preJavascript !== ''){
            try{
                eval(data.preJavascript);
            }
            catch(e){
                console.log('Error executing preJavascript: ' + e.message);
                console.log(data.preJavascript);
            }
        }

        if (data.title !== null){
            window.jQuery('title').html(data.title);
        }

        if (data.keywords !== null){
            window.jQuery('meta[name=keywords]').attr('content', data.keywords);
        }

        if (data.description !== null){
            window.jQuery('meta[name=description]').attr('content', data.description);
        }

        for(var key in data.replace){
            window.jQuery(key).html(data.replace[key]);
        }
        for(var key in data.append){
            window.jQuery(key).append(data.append[key]);
        }
        for(var key in data.prepend){
            window.jQuery(key).prepend(data.prepend[key]);
        }
        if (data.postJavascript !== ''){
            try{
                eval(data.postJavascript);
            }
            catch(e){
                console.log('Error executing postJavascript: ' + e.message);
                console.log(data.postJavascript);
            }
        }
        lucid.messages.show(status, data.messages);
    }else{
        lucid.messages.show('error', ['Invalid response from server: '+statusCode]);
        console.log(xhr);
    }
    //lucid.callHandlers('post-handleResponse', {'jqxhr':xhr, 'statusCode':statusCode});
};
