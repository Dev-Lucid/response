if (typeof lucid === 'undefined') {
    var lucid = {};
}
if (typeof lucid.response === 'undefined') {
    lucid.response = {};
}

if (typeof(lucid.messages) != 'object') {
    lucid.messages.show=function(status, messageList){
        var text = status + '\n------------------------------\n';
        text += messageList.join('\n');
        alert(text);
    };
}

lucid.response.json =function(xhr, statusCode){
    lucid.response.json.beforeHandleResponse(xhr.responseJSON);
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
        if (data.messages.length > 0) {
            lucid.messages.show(statusCode, data.messages);
        }

    }else{
        //lucid.messages.show('error', ['Invalid response from server: '+statusCode]);
        lucid.messages.show(statusCode, xhr.responseJSON.data.messages);
        console.log(xhr);
    }
    lucid.response.json.afterHandleResponse(xhr.responseJSON);
};

lucid.response.json.beforeHandleResponse=function(json) {
};
lucid.response.json.afterHandleResponse=function(json) {
};