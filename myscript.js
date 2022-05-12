const items = document.querySelectorAll('.item')

items.forEach(item=>{
    item.addEventListener('click', (e)=>{
        items.forEach(elm=>{
            if(item!==elm){
                elm.classList.remove('active')
            }
        })
        item.classList.contains('active') ? item.classList.remove('active') : item.classList.add('active')
    })
})

