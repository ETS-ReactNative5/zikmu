import React, {useState, useEffect, useContext, Suspense} from 'react'
import { View, Text, FlatList, TouchableOpacity} from 'react-native'

import axios from 'axios';

import {ReactReduxContext, connect} from 'react-redux';
import {useNavigation} from '@react-navigation/native';

function RecentComponent() {

    const [recent, setRecent] = useState([]);

    const { store } = useContext(ReactReduxContext);

    const navigation = useNavigation();

    useEffect(() => {
        _get_recent().then((json) => setRecent(json.categories.items))
    });

    const _get_recent = (after = null) => {
        let url = `https://api.spotify.com/v1/me/player/recently-played`;
        after ? url += `?after=${after}` : url;
        const promise = axios.get(url, {
            headers: {
                Accept: "application/json",
                Authorization: 'Bearer ' + store.getState().authentication.accessToken,
                "Content-Type": 'application/json',
            }
        });
        const response = promise.then((data) => data.data);
        return response;
    }

    return (
        <Suspense fallback={null}>
            <FlatList
                style={{display: "flex", flexDirection:'row'}}
                data={recent} 
                scrollEnabled={true}
                horizontal={true}
                onEndReachedThreshold={0.5}
                onEndReached={() => {
                    _get_recent(recent[recent.length]?.item?.track?.id ?? null).then((data) => setRecent(recent, [...props, data]));
                }}
                renderItem={({item, key}) => (
                    <TouchableOpacity onPress={() => {}}>
                        <View style={{width: 116, padding: 0, backgroundColor: 'transparent', margin: 5}}>
                            <Image source={{uri: item?.track?.album?.images[0]?.url}}
                            style={{width: 116, height: 116, margin: "auto"}} />
                            <View>
                                <Text style={{fontWeight: 'bold', color: 'white'}}>{item?.track?.artists[0]?.name}</Text>
                                <Text style={{maxWidth: 150}}>{item?.track?.name}</Text>
                            </View>
                        </View>
                    </TouchableOpacity>
                )}
            />
        </Suspense>
    )
}

const mapStateToProps = store => {
    props: store.props
}

export default connect(mapStateToProps)(RecentComponent);