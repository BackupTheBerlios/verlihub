function ChangeImg(id, zaco) {
    var obrazek = najdi(document, id, 0);
    if (obrazek) {
        obrazek.src = zaco;
    }
}

function najdi(doc, name, j) {
    var obrazek = false;
    if (doc.images) {
        obrazek = doc.images[name];
    }
    if (obrazek) {
        return obrazek;
    }
    if (doc.layers) {
        for (j = 0; j < doc.layers.length; j++) {
            obrazek = najdi(doc.layers[j].document, name, 0);
            if (obrazek) {
                return (obrazek);
            }
        }
    }
    return (false);
}