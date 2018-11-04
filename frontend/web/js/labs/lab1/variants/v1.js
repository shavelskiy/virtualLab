var elements = {
    '1': {
        'E': 5,
        'R1': 20,
        'R': 50,
    },
    '2': {
        'E': 5,
        'R1': 20
    },
    '3': {
        'E': 5,
        'R1': 1000,
        'R2': 800
    },
    '4': {
        'R1': 1000,
        'R2': 2000,
        'R': 200,
        'E': 5
    },
    '5': {
        'R1': 1000,
        'R2': 2000,
        'R3': 10000,
        'R4': 100,
        'R': 200
    }
};

var potentials = {
    '1': {
        '0': 0,
        '1': 0
    },
    '2': {
        '0': 0,
        '1': 5
    }
};

var variant = 1;

function getPotDif() {
    pot = potentials[schemeNum];
    return pot[point2] - pot[point1];
}

function getOm() {
    switch (schemeNum) {
        case 1:
            var value = elems['R1'] * elems['R'] / (elems['R1'] + elems['R']);
            return Math.round(value * 1000) / 1000;
        case 2:
            return elems['R1'];
    }
}
