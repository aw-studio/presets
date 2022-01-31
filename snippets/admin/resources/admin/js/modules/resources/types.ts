export type Resource<Model> = {data: Model};
export type CollectionResource<Model> = {data: Model[]};

export type DateTime = {
    readable_diff: string
}

export type State = {
    label: string,
    value: string,
}

export type DateTimesResource = Resource<DateTime>;
export type StatesResource = Resource<State>;