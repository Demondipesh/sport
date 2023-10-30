<div id="getMatch" class=" flex flex-col gap-2 w-full">
    <h2 class='text-xl text-gray-400 '>ICC Mens T20I World Cup Asia Finals 2023</h2>


</div>

<div id="getMatch2" class=" flex flex-col gap-2 w-full">
    <h2 class='text-xl text-gray-400 '>ICC Cricket World Cup 2023</h2>


</div>



<script>
    function getData() {
        fetch("https://api.cricapi.com/v1/series_info?apikey=1a29e0c3-dbc1-465a-b114-e469f61e9103&offset=1&id=a494636e-9537-4ed9-9e8d-43708b202f81")
            .then(response => response.json())
            .then(result => {
                var match = result.data.matchList;


                let getMatch = document.getElementById('getMatch');

                function filterMatches(matches) {
                    const now = new Date();
                    const pastMatches = matches.filter(match => new Date(match.dateTimeGMT) < now && match.matchEnded === true);
                    const futureMatches = matches.filter(match => new Date(match.dateTimeGMT) > now);

                    if (pastMatches.length > 0 && futureMatches.length > 0) {
                        return [pastMatches[0], futureMatches[0]];
                    } else if (pastMatches.length > 0) {
                        return [pastMatches[0]];
                    } else if (futureMatches.length > 0) {
                        return [futureMatches[0]];
                    } else {
                        return [];
                    }
                    
                }

                const matches = filterMatches(match);


                function renderMatches(matches) {
                    console.log(matches);

                    matches.forEach(match => {
                        getMatch.innerHTML += `
                            <div class="flex flex-col p-2 rounded bg-gray-200 relative w-full">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="flex flex-col gap-2 items-center">
                                        <img src="${match.teamInfo[0].img}" class="h-10 w-10 rounded-full" alt="Nep">
                                        <p>${match.teamInfo[0].shortname}</p>
                                    </div>
                                    <p> - </p>
                                    <div class="flex flex-col gap-2 items-center">
                                        <img src="${match.teamInfo[1].img}" class="h-10 w-10 rounded-full" alt="Nep">
                                        <p>${match.teamInfo[1].shortname}</p>
                                    </div>
                                </div>
                                <p class='text-sm'>${match.status}</p>
                                ${match.isEnded ? '<p class="top-0 right-50 h-8 w-12 bg-red-200 p-2 rounded text-center">Ended</p>' : ''}
                                ${new Date(match.dateTimeGMT) < new Date() && !match.matchEnded ? '<p class="top-0 right-50 h-8 w-12 bg-red-200 p-2 rounded text-center">Live</p>' : ''}
                            </div>
                        `;
                    });
                }

                renderMatches(matches);
            });
    }

    function getWorldcup(){
        let url = 'bd830e89-3420-4df5-854d-82cfab3e1e04'
        fetch("https://api.cricapi.com/v1/series_info?apikey=1a29e0c3-dbc1-465a-b114-e469f61e9103&offset=1&id=bd830e89-3420-4df5-854d-82cfab3e1e04")
            .then(response => response.json())
            .then(result => {
                var match = result.data.matchList;


                let getMatch = document.getElementById('getMatch2');

                function filterMatches(matches) {
                    const now = new Date();
                    const pastMatches = matches.filter(match => new Date(match.dateTimeGMT) < now && match.matchEnded === true);
                    const futureMatches = matches.filter(match => new Date(match.dateTimeGMT) > now);

                    if (pastMatches.length > 0 && futureMatches.length > 0) {
                        return [pastMatches[0], futureMatches[0]];
                    } else if (pastMatches.length > 0) {
                        return [pastMatches[0]];
                    } else if (futureMatches.length > 0) {
                        return [futureMatches[0]];
                    } else {
                        return [];
                    }
                    
                }

                const matches = filterMatches(match);


                function renderMatches(matches) {
                    console.log(matches);


                    matches.forEach(match => {
                        getMatch.innerHTML += `
                            <div class="flex flex-col p-2 rounded bg-gray-200 relative w-full">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="flex flex-col gap-2 items-center">
                                        <img src="${match.teamInfo[0].img}" class="h-10 w-10 rounded-full" alt="Nep">
                                        <p>${match.teamInfo[0].shortname}</p>
                                    </div>
                                    <p> - </p>
                                    <div class="flex flex-col gap-2 items-center">
                                        <img src="${match.teamInfo[1].img}" class="h-10 w-10 rounded-full" alt="Nep">
                                        <p>${match.teamInfo[1].shortname}</p>
                                    </div>
                                </div>
                                <p class='text-sm'>${match.status}</p>
                                ${match.isEnded ? '<p class="top-0 right-50 h-8 w-12 bg-red-200 p-2 rounded text-center">Ended</p>' : ''}
                                ${new Date(match.dateTimeGMT) < new Date() && !match.matchEnded ? '<p class="top-0 right-50 h-8 w-12 bg-red-200 p-2 rounded text-center">Live</p>' : ''}
                            </div>
                        `;
                    });
                }

                renderMatches(matches);
            });
    }


    getData();
    getWorldcup();
</script>