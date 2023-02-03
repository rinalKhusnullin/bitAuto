
function dropdown() {

    document.getElementById("dropdown-content").classList.toggle("visible");

    if (document.getElementById("dropdown-btn").classList.contains("droped")) 
    {
        document.getElementById("dropdown-btn").classList.remove('droped');
        document.getElementById("dropdown-btn").classList.add('undroped');
    }
    else if (document.getElementById("dropdown-btn").classList.contains("undroped")) 
    {
        document.getElementById("dropdown-btn").classList.remove('undroped');
        document.getElementById("dropdown-btn").classList.add('droped');
    } 
}

window.onclick = function (event) 
{
    if (!event.target.matches('.dropdown-btn')) 
    {
        if (document.getElementById("dropdown-content").classList.contains("visible"))
        {
            document.getElementById("dropdown-btn").classList.remove('droped');
            document.getElementById("dropdown-btn").classList.add('undroped');
        } 

        var dropdowns = document.getElementsByClassName("header__dropdown-tags");
        var i;
        
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];

            if (openDropdown.classList.contains('visible')) 
            {
                openDropdown.classList.remove('visible');
            }
        }
    }
}