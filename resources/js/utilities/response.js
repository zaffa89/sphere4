export const is400 = function(err){
    return isErrorWithResponseAndStatus(err) && 400 === err.response.status;
};

export const is401 = function(err){
    return isErrorWithResponseAndStatus(err) && 401 === err.response.status;
};

export const is403 = function(err){
    return isErrorWithResponseAndStatus(err) && 403 === err.response.status;
};

export const is404 = function(err){
    return isErrorWithResponseAndStatus(err) && 404 === err.response.status;
};

export const is422 = function(err) {
    return isErrorWithResponseAndStatus(err) && 422 === err.response.status;
}

export const is201 = function(response){
    return 201 === response.status;
}

export const is200 = function(response){
    return 200 === response.status;
}

export const is202 = function(response){
    return 202 === response.status;
}

const isErrorWithResponseAndStatus = function (err) {
    return err.response && err.response.status;
}