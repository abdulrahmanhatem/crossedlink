function social_login_popup(url) {
    //newwindow=window.open(url,'name','height=500,width=600');
    newwindow=window.open(url,'_self');
    if (window.focus) {newwindow.focus()} 
    return false;
}


