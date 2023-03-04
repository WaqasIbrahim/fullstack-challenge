export type Weather = {
    location: {
        name: string | null;
        countryCode: string | null;
    };
    condition: string;
    description: string;
    iconUrl: string;
    temperature: {
        value: number;
        feelsLike: number;
        min: number;
        max: number;
    };
    updatedAt: string;
};

export type User = {
    id: number;
    name: string;
    email: string;

    weather?: Weather | null;
};
