import io from "socket.io-client"
import { sortTablePositions , addSerialNumber,checkRecentUpdates } from "./common"
// const socket = io(`${import.meta.env.VITE_SOCKET_SERVER}`,
//     {
//         transports: ["websocket","polling"]
//     }
// );


/** @returns {void} */
// async function main(socket) {
//     socket.on("welcome",function (welcomeMessage ){
//         console.log(welcomeMessage)
//     });
//
//     socket.on("score-updated:mela",async function (score) {
//         $(`#${score.id}`).empty();
//         $(`#${score.totalId}`).empty()
//
//         $(`#${score.id}`).append(score.time);
//         $(`#${score.id}`).addClass('blink');
//         $(`#${score.id}`).attr('data-timestamp',score.timestamp);
//
//         $(`#${score.totalId}`).append(score.total)
//         $(`#${score.totalId}`).attr('data-total',`${score.totalInSeconds}`)
//
//         await sortTablePositions();
//         await addSerialNumber();
//         await checkRecentUpdates()
//
//     });
// }

// main(socket);

