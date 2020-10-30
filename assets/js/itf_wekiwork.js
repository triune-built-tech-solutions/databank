// load data-offices
let Getoffices = document.querySelectorAll("*[data-offices]");
        
if (Getoffices.length > 0)
{
    [].forEach.call(Getoffices, function(offices)
    {
        // get json
        var json = offices.getAttribute('data-offices');
        var parent = offices.parentNode;

        // convert to real json object
        json = json.replace(/(['])/g,'"');
        json = JSON.parse(json);

        // get search input
        var searchInput = parent.querySelector('*[data-search="search-offices"]');

        // objectpassed
        var jsonPassed = {};

        // selected 
        var listSelected = {};

        // update
        var update = parent.querySelector('*[data-action="update"]');

        // load json to view
        var dataView = parent.querySelector('*[data-select="list"]');

        if (dataView != null)
        {
            loadView();
            searchInput.addEventListener('keyup', loadView);
        }

        // select info
        var selectinfo = parent.querySelector('.select-info').firstElementChild;

        function loadView(text=null, select = false)
        {
            dataView.innerHTML = '';

            let copy = json;

            if (text !== null)
            {
                const val = this.value;
                if (val == '')
                {
                    copy = json;
                }   
            }

            // build list
            for (var inp in copy)
            {
                let add = false;

                if (text !== null)
                {
                    var val = this.value;
                    if (val == '')
                    {
                        add = true;
                        jsonPassed = {};
                    }
                    else
                    {
                        var reg = new RegExp(val,'gi');
                        if (inp.match(reg))
                        {
                            add = true;
                            jsonPassed[inp] = copy[inp];
                        }
                    }
                }
                else
                {
                    add = true;
                    jsonPassed = {};
                }

                if (add)
                {
                    // create new dom for list
                    let lst = document.createElement('div');
                    lst.className = 'select not';
                    lst.setAttribute('data-id', copy[inp]);

                    // create list child node
                    let lstChild = document.createElement('i');
                    lstChild.className = 'fa fa-plus';
                    lst.appendChild(lstChild);
                    lst.appendChild(document.createTextNode(inp));
                    dataView.appendChild(lst);

                    if (select === true)
                    {
                        clickfunc();
                    }

                    // now manage select and unselect
                    lst.addEventListener('click', clickfunc);

                    function clickfunc()
                    {
                        // get id
                        const id = lst.getAttribute('data-id');

                        if (lst.hasAttribute('data-clicked'))
                        {
                            // remove id from list
                            let officesArray = [];
                            offices.value.split(',').map((val)=>{
                                if (val != id)
                                {
                                    officesArray.push(val);
                                }
                            });
                            offices.value = officesArray.toString();
                            lst.className = 'select not';
                            lst.removeAttribute('data-clicked');
                            lstChild.className = 'fa fa-plus';
                            listSelected[id] = 'remove';

                            if (offices.hasAttribute('data-trigger'))
                            {
                                var trigger = offices.getAttribute('data-trigger');
                                window[trigger]('unclicked', id);
                            }
                        }
                        else
                        {
                            lst.className = 'select selected';
                            lst.setAttribute('data-clicked', true);
                            let officeArray = offices.value.split(',') || [];
                            if (officeArray.indexOf(id) === -1)
                            {
                                officeArray.push(id);
                            }
                            officeArray.toString();
                            offices.value = officeArray;
                            lstChild.className = 'fa fa-minus';
                            listSelected[id] = 'selected';

                            if (offices.hasAttribute('data-trigger'))
                            {
                                var trigger = offices.getAttribute('data-trigger');
                                window[trigger]('clicked', id);
                            }
                        }

                        addcount();
                    
                    }
                }
            }

            for (var id in listSelected)
            {
                if (listSelected[id] != 'remove')
                {
                    // find child 
                    const findChild = dataView.querySelector('*[data-id="'+id+'"]');
                    if (findChild != null)
                    {
                        findChild.className = 'select selected';
                        findChild.setAttribute('data-clicked', true);
                        findChild.firstElementChild.className = 'fa fa-minus';
                    }
                }
            }
        }

        if (update === null)
        {
            if (offices.value.split(',').length < Object.values(json).length && !offices.hasAttribute('data-autoselect'))
            {
                update = true;
            }
        }

        function addcount(sub = 1)
        {
            if (update !== null)
            {
                //sub = 0;
            }

            let count = offices.value.split(',').length-1;

            if (count >= Object.keys(json).length-1)
            {
                count = Object.keys(json).length-1;
            }

            selectinfo.innerText = count;
        }

        // select all
        var selectall = parent.querySelector('.select-all');
        if (selectall != null)
        {
            
            selectall.addEventListener('click', ()=>{
                var text = searchInput.value || null;

                if (selectall.hasAttribute('data-clicked'))
                {
                    selectall.firstElementChild.className = 'fa fa-plus';
                    selectall.removeAttribute('data-clicked');
                    selectall.innerHTML = selectall.firstElementChild.outerHTML + ' Add All';
                    var obj = Object.create(null);
                    obj.value = text;
                    listSelected = {};
                    loadView.call(obj, text);
                    offices.value = '';
                    selectinfo.innerText = '0';
                    if (offices.hasAttribute('data-trigger'))
                    {
                        var trigger = offices.getAttribute('data-trigger');
                        window[trigger]('unclicked', null);
                    }   
                }
                else
                {
                    selectall.firstElementChild.className = 'fa fa-minus';
                    selectall.innerHTML = selectall.firstElementChild.outerHTML + ' Cancel';
                    selectall.setAttribute('data-clicked', true);
                    var obj = Object.create(null);
                    obj.value = text;
                    loadView.call(obj, text, true);

                }
            });
        }

        // pick target for update
        if (update !== null)
        {
            offices.value.split(',').map((id)=>{
                listSelected[id] = 'selected';
                // find child 
                const findChild = dataView.querySelector('*[data-id="'+id+'"]');
                if (findChild != null)
                {
                    findChild.className = 'select selected';
                    findChild.setAttribute('data-clicked', true);
                    findChild.firstElementChild.className = 'fa fa-minus';
                }
            });

            addcount(0);
        }
    });
}

// input calender
let calender = document.querySelectorAll('.input-calender');
if (calender.length > 0)
{
    [].forEach.call(calender, function(e){
        var childs = e.querySelectorAll('span');
        [].forEach.call(childs, function(c){
            if (c.className != 'inactive')
            {
                c.addEventListener('click', function(){
                    uncheckall(e);
                    // check now
                    c.className = 'active';
                    e.parentNode.firstElementChild.value = c.innerText;
                });


            }
        });

        function uncheckall(e)
        {
            var childs = e.querySelectorAll('span');
            [].forEach.call(childs, function(c){
            if (c.className != 'inactive')
            {
                c.removeAttribute('class');
            }
            e.parentNode.firstElementChild.value = '';
        });
        }
    });
}

//manage delete alert
window.onload = function()
{
    let del = document.querySelector('.ask-question');
    if (del != null)
    {
        del.style.bottom = '0px';
    }

    let targ = document.querySelector('[name="target_interval"]');
    if (targ != null)
    {
        if (targ.value.length > 0)
        {
            interval(targ);
        }
    }

    if (Getoffices.length > 0)
    {
        [].forEach.call(Getoffices, function(offices)
        {
            var selectall = offices.parentNode.querySelector('.select-all');

            if (location.href.indexOf('?edit') === -1 && !offices.hasAttribute('data-autoselect'))
            {
                if (selectall != null)
                {
                    // get json
                    var json = offices.getAttribute('data-offices');

                    // convert to real json object
                    json = json.replace(/(['])/g,'"');
                    json = JSON.parse(json);

                    if (offices.value.split(',').length == Object.values(json).length)
                    {
                        selectall.click();
                    }
                }
            }
            else
            {
                let cont = true;

                if (offices.hasAttribute('data-autoselect'))
                {
                    var autosel = offices.getAttribute('data-autoselect');
                    if (autosel == 'false')
                    {
                        cont = false;
                    }
                }

                if (cont)
                {
                    const count = offices.value.split(',').length;
                    // get json
                    let json = offices.getAttribute('data-offices');
                    // convert to real json object
                    json = json.replace(/(['])/g,'"');
                    json = JSON.parse(json);

                    var array = Object.keys(json).map(function(val, key){ return key;});
                    if (array.length == count)
                    {
                        // activate cancel
                        selectall.click();
                    }
                }
            }
        });
    }
};

// get interval
function interval(ele){
    // get value
    let val = ele.value;
    if (val.length > 1)
    {
        let interval = document.querySelectorAll('*[data-interval]');
        if (interval.length > 0)
        {
            [].forEach.call(interval, function(ele){
                // hide first
                ele.style.display = 'none';
                ele.removeAttribute('required');

                // show for this interval
                // get attribute
                var attr = ele.getAttribute('data-interval').split('|');
                if (attr.indexOf(val) >= 0)
                {
                    ele.style.display = 'block';
                    ele.setAttribute('required','yes');
                }
            });

            $('.datepicker').datepicker({
                format: 'mm/yyyy',
                startDate: '-3d'
            });
        }
    }
    else
    {
        [].forEach.call(document.querySelectorAll('*[data-interval]'), function(e){
            e.style.display = 'none';
        });

    }
}

// remove outcome
function removeOutcome(parent)
{
    // remove
    parent.parentNode.removeChild(parent);
}

// add outcome
function addOutcome(ele)
{
    var template = '<div class="w1-8">\
        <input type="text" name="outcome[]" class="form-control" placeholder="Performance Outcome"/>\
    </div>\
    <div class="w8-14">\
        <input type="text" name="outcome_period[]" class="form-control" placeholder="Annual/Monthly Target"/>\
    </div>\
    <div class="w14-18">\
        <button type="button" class="btn btn-danger" onclick="removeOutcome(this.parentNode.parentNode);"> <i class="fa fa-minus"></i> Remove </button>\
    </div>';
    // current object
    var div = document.createElement('div');
    div.className = 'w1-18 wrapper column-gap10';
    div.innerHTML = template;

    // append element
    ele.parentNode.appendChild(div);
}

function log()
{
    console.log.apply(this, arguments);
}

// build form action button
(function(e){
    // define var
    var _buildform, form_data;
    // use var
    _buildform = document.querySelector('#build-form-btn'),
    form_data = document.querySelector('*[name="form_data"]');

    // check if is not null
    if (_buildform != null)
    {
        // listen for click event
        _buildform.addEventListener('click', function(e){
            e.preventDefault();
            
            // look for form group
            var build = document.querySelector('#build'), group = build.querySelectorAll('.form-group');
            if (group.length > 0)
            {
                var confirm = window.confirm('Are you done creating your form?');
                if (confirm)
                {
                   // build json data
                   var nullArray = [], label, element, allowed = ['label','input','button','textarea','select'];

                   [].forEach.call(group, function(e){

                        var object = Object.create(null), nullArray2=[];

                        // get label and inputs
                        allowed.forEach(function(ele){
                            element = e.querySelectorAll(ele);
                            if (element.length > 0)
                            {

                                [].forEach.call(element, function(elem){
                                    var parent = elem.parentNode,
                                    parentClass = parent.className,
                                    nodename, attributes;

                                    // get node name
                                    nodename = elem.nodeName.toLowerCase();
                                    // get attributes
                                    attributes = getAttribute(elem);

                                    if (parentClass == 'form-group')
                                    {
                                        object.element = nodename;
                                        object.attributes = attributes;
                                        if (elem.innerText.length > 0)
                                        {
                                            object.text = elem.innerText;
                                        }
                                    }
                                    else
                                    {
                                        var object1 = Object.create(null), nullArray1 = [], object2 = Object.create(null);
                                        object1.name = parent.nodeName.toLowerCase();
                                        object1.attributes = getAttribute(parent);
                                        object2.element = nodename;
                                        object2.attributes = attributes;
                                        if (elem.innerText.length > 0)
                                        {
                                            object2.text = elem.innerText;
                                        }
                                        object1.element = object2;
                                        nullArray1.push(object1);
                                        object.parent = nullArray1;
                                    }

                                });
                            }
                        });

                        nullArray.push(object);
                   }); 

                   var json = JSON.stringify(nullArray), formname = document.querySelector('*[name="form_name"]');
                   form_data.value = json;
                   formname.value = build.querySelector('legend').innerText.trim();


                   // submit form
                   form_data.parentNode.submit();
                }
            }
        })
    }

    // get attributes
    function getAttribute(element) {
        var attr = element.attributes, attrArray = [], len, i, item, object;
        if (attr.length > 0)
        {
            len = attr.length;
            for (i=0; i<len; i++)
            {
                item = element.attributes.item(i);
                object = Object.create(null);
                object.name = item.nodeName;
                object.value = item.value;
                attrArray.push(object);
            }
        }
        return attrArray;
    }

    // read data-entry
    var dataEntry = document.querySelector('*[data-entry="name-list"]'), 
    dataEntryList = null,
    dataListener = document.querySelector('*[data-entry="listen"]'),
    titleOptions = null;


    if (dataEntry != null)
    {
        dataListener.addEventListener('change', function(r){
            if (this.value.length > 0)
            {
                dataEntryList = document.querySelectorAll('*[data-entry="names"]');
                getJsonEntry(this.value);
            }
        });

        function resetEntry()
        {
            dataEntryList.innerHTML = '';
        }

        function getJsonEntry(id)
        {
            var data = JSON.parse(dataEntry.innerText.trim());
            var list = data['entry'+id];

            // build option
            if (list.length > 0)
            {
                if (dataEntryList.length > 0)
                {
                    [].forEach.call(dataEntryList, function(dea){
                        if (titleOptions == null)
                        {
                            titleOptions = dea.innerHTML;
                        }

                        dea.innerHTML = titleOptions;

                        list.forEach(function(val){
                            var option = document.createElement('option');
                            option.value = val;
                            option.innerText = val;
                            option.setAttribute('data-option', id);
                            dea.appendChild(option);
                        });
                    });
                }
                
            }
        }
    }

    // copy 
    var copybutton = document.querySelectorAll('*[data-copy]');
    if (copybutton.length > 0)
    {
        [].forEach.call(copybutton, function(btn){
            btn.addEventListener('click', function(e){
                e.preventDefault();
                // get class
                var className = btn.getAttribute('data-copy');
                // get class
                var getclass = document.querySelector('.'+className);
                if (getclass != null)
                {
                    // create row
                    var row = document.createElement('div');
                    row.className = getclass.className;
                    row.innerHTML = getclass.innerHTML;
                    getclass.parentNode.appendChild(row);
                }
            });
        });
    }
})(window);

