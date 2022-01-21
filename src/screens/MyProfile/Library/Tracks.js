//import liraries
import React, {Component, useContext, useState} from 'react';
import {View, Text, StyleSheet, FlatList} from 'react-native';
import {TouchableOpacity} from 'react-native-gesture-handler';
import {connect, ReactReduxContext} from 'react-redux';
import TrackItem from '../../../components/Track/TrackItem';
import axios from 'axios';
import {useNavigation} from '@react-navigation/native';

class Tracks extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      tracks: null,
    };
    props.navigation.setOptions({
      title: 'Mes favoris',
    });
  }

  _get_tracks = (offset = 0) => {
    const promise = axios.get('https://api.spotify.com/v1/me/tracks', {
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + this.props.store.authentication.accessToken,
        'Content-Type': 'application/json',
      },
    });
    const response = promise.then(data => data);
    return response;
  };

  componentDidMount() {
    this._get_tracks().then(data => setTracks(data.data));
  }

  render() {
    return (
      <View style={styles.container}>
        <FlatList
          data={tracks?.items}
          scrollEnabled={true}
          horizontal={false}
          onEndReachedThreshold={0.1}
          onEndReached={() => {
            _get_tracks(tracks.length).then(json =>
              setTracks(tracks => tracks?.items?.concat(json.items)),
            );
          }}
          renderItem={({item, key}) => (
            <TrackItem
              track={item.track}
              album={item?.track?.album}
              favorites={true}
            />
          )}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#2c3e50',
  },
});

const mapStateToProps = store => {
  return {
    store: store,
  };
};

export default connect(mapStateToProps)(Tracks);