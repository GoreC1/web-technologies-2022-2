if (document.readyState === 'loading') 
  {
    document.addEventListener('DOMContentLoaded', loadAll)
  } 
else 
  {
    loadAll()
  }
  
  function loadAll() {
    const data = {
      name: 'Каталог товаров',
      hasChildren: true,
      items: [
        {
          name: 'Мойки',
          hasChildren: true,
          items: [
            {
              name: 'Ulgran1',
              hasChildren: true,
              items: [
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                },
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                }
              ]
            },
            {
              name: 'Vigro Mramor',
              hasChildren: false,
              items: []
            },
            {
              name: 'Handmade',
              hasChildren: true,
              items: [
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                },
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                }
              ]
            }
          ]
        },
        {
          name: 'Фильтры',
          hasChildren: true,
          items: [
            {
              name: 'Ulgran',
              hasChildren: true,
              items: [
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                },
                {
                  name: 'Smth',
                  hasChildren: false,
                  items: []
                }
              ]
            },
            {
                name: 'Vigro Mramor',
                hasChildren: false,
                items: []
            }
          ]
        }
      ]
    }
    
    
    const items = new ListItems(document.getElementById('list-items'), data)
    
    
    items.prepare();
    items.loadAll();
    
    function ListItems(el, data) 
    {
      this.el = el;
      this.data = data;
      
      this.loadAll = function () 
      {
        const parents = this.el.querySelectorAll('[data-parent]')
        
        parents.forEach(parent => 
        {
          const open = parent.querySelector('[data-open]')
          
          open.addEventListener('click', () => this.toggleItems(parent) )
        })
      }
      
      this.prepare = function () 
      {
        this.el.insertAdjacentHTML('beforeend', this.prepareParent(this.data))
      }
      
      this.prepareParent = function (data) 
      {
        let result = '';
        
        if (data.hasChildren) 
        {  
        result = `
        <div class="list-item" data-parent>
        <div class="list-item__inner">
        <img class="list-item__arrow" src="./img/chevron-down.png" alt="chevron-down" data-open>
        <img class="list-item__folder" src="./img/folder.png" alt="folder">
        <span>${data.name}</span>
        </div>
        <div class="list-item__items">`;

          for (let i in data.items) 
          {
            result += this.prepareParent(data.items[i])
          }
        }
        else 
        {
        result = `<div class="list-item" data-parent>
        <div class="list-item__inner">
        <div class="list-item__arrow__inactive" alt="chevron-down" data-open> </div>
        <img class="list-item__folder" src="./img/folder.png" alt="folder">
        <span>${data.name}</span>
        </div>
        <div class="list-item__items">`
        }

        result += `</div></div>`
        return result
      }
      
      this.renderChildren = function (data) 
      {
        return `<div class="test">${data.name}</div>`
      }
      
      this.toggleItems = function (parent) 
      {
        parent.classList.toggle('list-item_open')
      }
    }
    
  }