import React, {useState, useEffect, useContext} from 'react';
import { View, Text, TextInput, FlatList, TouchableOpacity, Image, ScrollView } from 'react-native';
import {useNavigation} from '@react-navigation/native';

import axios from 'axios';

import { connect, ReactReduxContext } from 'react-redux';
import TrackItem from '../../components/Track/TrackItem';
import ArtistItem from '../../components/Artist/ArtistItem';

/** components */

function SearchScreen() {

    const [search, setSearch] = useState('');
    const [results, setResults] = useState([]);

    const { store } = useContext(ReactReduxContext)

    const navigation = useNavigation()

    const _search = (e) => {
        setSearch(e);
        axios.get(`https://api.spotify.com/v1/search?q=${e}&limit=3&type=track,artist,album`, {
            headers: {
                Accept: "application/json",
                Authorization: "Bearer " + store.getState().authentication.accessToken,
                "Content-Type": "application/json"
            }
        })
        .then((data) => setResults(data.data));
    }

    return (
        <ScrollView style={{flex: 1, backgroundColor: 'black'}}>
            <TextInput onChangeText={_search} placeholder={"Rechercher"} value={search} />
            <View>
                <Text>Artistes</Text>
                <FlatList
                    data={results?.artists?.items}
                    scrollEnabled={false}
                    renderItem={({item, key}) => (
                        <ArtistItem artist={item} />
                    )}
                />
            </View>
            <View>
                <Text>Titres</Text>
                <FlatList
                    data={results?.tracks?.items}
                    scrollEnabled={false}
                    horizontal={false}
                    renderItem={({item, key}) => (
                        <TrackItem track={item} />
                    )}
                />
            </View>
            <View style={{marginBottom: 110}}>
                <Text>Albums</Text>
                <FlatList
                    data={results?.albums?.items}
                    scrollEnabled={false}
                    horizontal={false}
                    renderItem={({item, key}) => (
                        <TrackItem track={item} />
                    )}
                />
            </View>
        </ScrollView>
    )
}

export default connect()(SearchScreen);
