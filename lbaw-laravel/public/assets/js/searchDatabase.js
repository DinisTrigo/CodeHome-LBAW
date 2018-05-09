'use strict'

document.getElementById("searchInput").addEventListener("keyup", handleUserSearchInput);

function handleUserSearchInput(event)
{
    let elementsList = document.getElementById('resultsList');
    elementsList.innerHTML = ``;
    let userInputText = event.target.value.trim();
    if (userInputText == "")
    {
        elementsList.style.display = 'none';
        return;
    } else
        elementsList.style.display = 'block';


    //ended flag
    let return_array;
    let ended_str = false;
    if ((return_array = searchAndReplaceInString(userInputText, "#ended"))[0])
    {
        ended_str = return_array[0];
        userInputText = return_array[1];
    }
    //working flag
    let working_str = false;
    if ((return_array = searchAndReplaceInString(userInputText, "#working"))[0])
    {
        working_str = return_array[0];
        userInputText = return_array[1];
    }
    let endedSearchString;
    if (ended_str == working_str)
        endedSearchString = "both";
    else if (ended_str)
        endedSearchString = "ended";
    else
        endedSearchString = "working";


    //select elements
    let projects_search = false;
    if ((return_array = searchAndReplaceInString(userInputText, "#projects"))[0])
    {
        projects_search = return_array[0];
        userInputText = return_array[1];
    }

    let lists_search = false;
    if ((return_array = searchAndReplaceInString(userInputText, "#lists"))[0])
    {
        lists_search = return_array[0];
        userInputText = return_array[1];
    }

    let items_search = false;
    if ((return_array = searchAndReplaceInString(userInputText, "#items"))[0])
    {
        items_search = return_array[0];
        userInputText = return_array[1];
    }

    if (projects_search == lists_search && lists_search == items_search)
    {
        projects_search = true;
        lists_search = true;
        items_search = true;
    }

    if (projects_search)
        getElementInSearch("Projects", userInputText, endedSearchString);
    if (lists_search)
        getElementInSearch("Lists", userInputText, endedSearchString);
    if (items_search)
        getElementInSearch("Items", userInputText, endedSearchString);
}

function getElementInSearch(element, userInputText, endedSearchString)
{
    let request = new XMLHttpRequest();
    request.addEventListener("load", function receiveServerResponse()
    {

        let elements = JSON.parse(this.responseText);
        if (elements.length == 0)
            return;

        let searchResultOptionsGroup = document.createElement('optgroup');
        searchResultOptionsGroup.label = element;
        let innerHTML = ``;
        for (let i = 0; i < elements.length; i++)
        {
            innerHTML += `<option class="` + elements[i]['id'] +
                    `" onclick="handle` + element + `Selection(event)" >` + elements[i]['name'] + `</option>`;
        }

        searchResultOptionsGroup.innerHTML = innerHTML;

        let elementsList = document.getElementById('resultsList');
        elementsList.insertAdjacentElement('beforeend', searchResultOptionsGroup);
    });
    request.open("GET", "../search/getUser" + element + ".php?" +
            encodeForAjax({name: userInputText, endedOption: endedSearchString}), true);
    request.send();
}