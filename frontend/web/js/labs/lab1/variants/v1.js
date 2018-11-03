var elements = {
    '1': {
        'E': 5,
        'R1': 20,
        'R': 50,
    }
};

var potentials = {
    '1': {
        '0': 0,
        '1': 0
    }
};

function getPotDif() {
    pot = potentials['1'];
    return pot[point2] - pot[point1];
}

function getOm() {
    var elems = elements['1'];
    var value =  elems['R1'] * elems['R'] / (elems['R1'] + elems['R']);
    return Math.round(value * 1000) / 1000;
}
