import dayjs from "dayjs";
import utc from "dayjs/plugin/utc"
import timezone from "dayjs/plugin/timezone"
import isBetween from "dayjs/plugin/isBetween"
import customParseFormat from "dayjs/plugin/customParseFormat"
const observer = lozad();
observer.observe();

dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(customParseFormat)
dayjs.extend(isBetween)
dayjs.tz.setDefault('Asia/Karachi')
// Count visitors
function onlineVisitorsCounter(){
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (this.readyState === 4 && this.status === 200){
            document.getElementById('online-users').innerText =`Online users: ${this.responseText}`
        }
    };
    xhr.open('GET', `${window.location.origin}/visitors.php`);
    xhr.send();
}
//LocalTime
setInterval(function (){
    document.getElementById('localdate').innerHTML = dayjs().tz("Asia/Karachi").format("DD-MM-YYYY h:mm:ss");
},1000)

//
$(".tournament").click(function (event) {
    window.location.href = event.target.href;
});

//


async function sortTablePositions(){
    try {
        const table = document.getElementById('results')
            , tableHead = table.querySelector('thead')
            , tableHeaders = tableHead.querySelectorAll('th')
            , tableBody = table.querySelector('tbody');
        let tableHeader = $('#total-h a')[0]
            , textContent = tableHeader.textContent
            , tableHeaderIndex
        ;
        if (textContent!=='add row') {
            while (tableHeader.nodeName!=='TH') {
                tableHeader = tableHeader.parentNode;
            }
            tableHeaderIndex = Array.prototype.indexOf.call(tableHeaders,tableHeader);
            tinysort(
                tableBody.querySelectorAll('tr')
                ,{
                    selector:'td:nth-child('+(tableHeaderIndex+1)+')'
                    ,data: "total"
                    ,'order':'desc'


                }
            );
        }
    }catch (e) {
        console.log(e)
    }finally {
        // onlineVisitorsCounter();
    }

}
function addSerialNumber() {
    $('table tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index);
    });
}

$(document).ready(function () {
    setTimeout(function (){
        // onlineVisitorsCounter();
        checkRecentUpdates();
    },1000);
});

function checkRecentUpdates(){
    $('#table-body tr').each(function(){
        $(this).find('td').each(function(){
            if ($(this).attr("data-timestamp") !== undefined){
                let time = $(this).attr("data-timestamp");
                time = dayjs(time);
                const now = dayjs().tz("Asia/Karachi");
                const add = time.add(20, 'm');
                const sub = time.subtract(20, 'm');
                if ( now.isBetween(add, sub)){
                    $(this).addClass('blink')
                }
                else{
                    $(this).removeClass('blink')
                }
            }

        })
    })
}
setInterval(function (){
    // onlineVisitorsCounter();
    checkRecentUpdates();
},120000)
$(".tournament").click(function (event) {
    window.location.href = event.target.href;
});
export {sortTablePositions,addSerialNumber,checkRecentUpdates}
